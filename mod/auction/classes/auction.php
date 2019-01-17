<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
class Auction {

    /**
     *
     * @var Auction
     */
    public static $inst = null;
    private $time;
    private $auction_id;

    private function __construct() {
        $db = Database::$inst;
        $checkCurrentAuction = $db->q("Select TOP 1 * From [DTWeb_Auctions] order by [id] desc", 2);
        $this->time = $checkCurrentAuction['time'];
        $this->auction_id = $checkCurrentAuction['id'];
        $this->checkAuction($checkCurrentAuction['time'], $checkCurrentAuction['id']);
    }

    public function checkAuction($time, $id) {
        if ($time <= time()) {
            if (empty($id)) {
                $this->startNewAuction();
            } else {
                $this->endAuction();
                $this->startNewAuction();
            }
        }
    }

    public function startNewAuction() {
        $items_arr = $this->randomItem();
        $itemhex = $this->generateItem($items_arr[1], $items_arr[0]);
        Database::$inst->q("INSERT INTO [DTWeb_Auctions] ([item], [time],[start_time]) VALUES ('{$itemhex}', " . (time() + Config::$inst->getAuctionConfig("time")) . ",".time().")");
    }
    public function ip() {
        $ipaddress = '0.0.0.0';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public function randomItem() {
        $allitems = Database::$inst->q("Select [id], [type] From [DTweb_JewelDeposit_Items] Where [auction]=1");
        $items_arr = array();
        while ($r = Database::$inst->fa($allitems)) {
            $items_arr[] = array($r['type'], $r['id']);
        }

        shuffle($items_arr);

        return $items_arr[0];
    }

    public function endAuction() {
		require $_SERVER['DOCUMENT_ROOT']."/inc/iteminfouser.php";
		$check_opt = mssql_fetch_array(mssql_query("Select * from DTweb_Auction_Settings"));
		$jd = json_decode($check_opt['resources']);
		$exclude = array("0");	
		$orig = array_diff($jd,$exclude);
	    mssql_query("Update [DTweb_Auction_Settings] set [column] = '".$orig[array_rand($orig)]."'");	
	
        $db = Database::$inst;
        $winner = $db->q("Select [DTweb_Auction_Bets].[user] From [DTweb_Auction_Bets], [DTWeb_Auctions]
                Where [auction_id]={$this->auction_id} and [DTWeb_Auctions].[id]={$this->auction_id} and [DTWeb_Auctions].[winner]=NULL
                order by [count] desc", 2);
        if ($winner['user']) {
            $item = $db->q("Select [item] From [DTWeb_Auctions] Where [id]={$this->auction_id}", 2);
            $iinfo = Iteminfouser($item['item']);
            $this->insertItem($item['item'], $iinfo['X'], $iinfo['Y'], $winner['user']);
            $db->q("UPDATE [DTWeb_Auctions] Set [winner]='{$winner['user']}',ip='".$this->ip()."',end_time='".time()."' Where [id]={$this->auction_id}");
            $not_winner = $db->q("Select * from [DTweb_Auction_Bets] where [auction_id]={$this->auction_id} and [user] !='{$winner['user']}'");
			if($check_opt['return_res'] == 1){
			while($upd = mssql_fetch_array($not_winner)){
				$db->q("Update DTweb_JewelDeposit set [".$upd['resource']."] = [".$upd['resource']."] + ".$upd['count']." where [memb___id]='{$upd['user']}'");
			}
		  }
		}    
    }

    public function whbin($account,$lenght =1200,$table = "warehouse",$user_col="AccountId",$item_col="items") {
		require $_SERVER['DOCUMENT_ROOT']."/inc/iteminfouser.php";
		    $lenght = season();
            if(phpversion() >= "5.3"){
        		$itemsa = mssql_fetch_array(mssql_query("SELECT [".$item_col."] FROM [".$table."] WHERE [".$user_col."]='".$account."'"));
        		  return strtoupper(bin2hex($itemsa[$item_col]));
        	}
        	else{
        		  return substr(mssql_get_last_message(mssql_query("declare @items varbinary(".$lenght[1]."); set @items=(select [".$item_col."] from [".$table."] where [".$user_col."]='".$account."'); print @items;")),2);	        	
        	}
        }

    public function generateItem($id, $type) {
		require $_SERVER['DOCUMENT_ROOT']."/inc/iteminfouser.php";
        $query = "Select * From [DTweb_JewelDeposit_Items] Where [id]={$id} and [type]={$type}";
        $i_info = mssql_fetch_array(mssql_query($query));
        $types = $type;
		$ids   = $id;
        //option create
        if ($i_info['exeopt'] == 4) {
            $excopt = Config::$inst->getAuctionConfig("excopt_wings");
            $level = Config::$inst->getAuctionConfig("level_wings");
        } else {
            if ($type < 7) {
                $excopt = Config::$inst->getAuctionConfig("excopt_wep");
            } else {
                $excopt = Config::$inst->getAuctionConfig("excopt_gear");
            }
            $level = Config::$inst->getAuctionConfig("level");
        }

        $BB += $level * 8;

        if (Config::$inst->getAuctionConfig("option") >= 4) {
            $BB += Config::$inst->getAuctionConfig("option") - 4;
            $HH += 64;
        } else {
            $BB += Config::$inst->getAuctionConfig("option");
        }

        if ($i_info['skill'] == 1 && Config::$inst->getAuctionConfig("skill") == 1) {
            $BB += 128;
        }

        if ($i_info['luck'] == 1 && Config::$inst->getAuctionConfig("luck") == 1) {
            $BB += 4;
        }

        if (Config::$inst->getAuctionConfig("randomoptions") != 0 && Config::$inst->getAuctionConfig("randomoptions") <= count($excopt)) {
            shuffle($excopt);
            for ($oid = 0; $oid < Config::$inst->getAuctionConfig("randomoptions"); $oid++) {
                $HH += $excopt[$oid];
            }
        } 
		elseif (Config::$inst->getAuctionConfig("randomoptions") == 0) {
            shuffle($excopt);
            for ($oid = 0; $oid < Config::$inst->getAuctionConfig("randomoptions"); $oid++) {
                $HH += 0;
            }
        }
		else {
            foreach ($excopt as $value) {
                $HH += $value;
            }
        }

        //end of option create

        $first = $type * 2;
        $second = $id;

        if ($first >= 16) {
            $HH += 128;
            $first -= 16;
        }

        if ($second > 15) {
            $first += 1;
            $second -= 16;
        }

        $names = ($type * 32) + $id;
        $AA = sprintf("%02X", $names, 00);

        if ($names >= 255) {
            $AA = substr($AA, 1, 2);
        } else {
            $AA = sprintf("%02X", $names, 00);
        }

        $BB = sprintf("%02X", $BB, 00);
        $CC = sprintf("%02X", 150, 00);
        $DDEE = strtoupper(getSerial());
        $GG = sprintf("%02X", $HH, 00);
        $ZZ = sprintf("%02X", 0, 0);
        $FF = sprintf("%02X", 0, 00);
		// Season patch
		// TODO :: new seasons auction options  -> Sockets, harmony and ancient items
	    
			$config = season();
			if($config[0] === 20){
				$itemhex = $AA . $BB . $CC . $DDEE . $GG . $ZZ . $FF;
			}
			else{
				$FF = sprintf("%02X", $type);
				$AA = sprintf("%02X", $id);
	            $itemhex = $AA . $BB . $CC . $DDEE . $GG . $ZZ . $FF . str_repeat('0',($config[0] - 20));						
			}			
		
      return $itemhex;		
    }

    public function getSerial() {
           $query = mssql_fetch_array(mssql_query("exec WZ_GetItemSerial"));
    		return sprintf("%08X", $query[0], 00000000);
    }


    public function insertItem($itemHex, $x, $y, $user) {
		require $_SERVER['DOCUMENT_ROOT']."/inc/iteminfouser.php";
		$config = season();
        $mycuritems = $this->whbin($user);
        $slot = $this->smartsearch($mycuritems, $x, $y);
		$items = Iteminfouser($itemHex);
	
        $mynewitems = substr_replace($mycuritems, $itemHex, (($slot * $config[0]) + 2), $config[0]);
		if($slot == 1337){
		mssql_query("Insert into DTweb_Storage ([item_type],[item_id], [item],[seller],[start_date],[seller_ip],[level],[skill],[luck],[options],[excellent],[name]) VALUES('".$items['type']."','".$items['id']."', '".$itemHex."','".$user."','".time()."','".$this->ip()."','".$items['level']."','".$items['skill']."','".$items['luck']."','".$items['opt']."','from auction','".$items['name']."')");	
		}
		else{
        mssql_query("update [warehouse] set [Items]={$mynewitems} where [AccountId]='{$user}'");
		}
    }

    public function smartsearch($whbin, $itemX, $itemY) {
        if (substr($whbin, 0, 2) == '0x') {
            $whbin = substr($whbin, 2);
        }
       require $_SERVER['DOCUMENT_ROOT']."/inc/iteminfouser.php";
        $conf = season();	   
        $items = str_repeat('0', 120);
        $itemsm = str_repeat('1', 120);
        $i = 0;
        while ($i < 120) {
            $_item = substr($whbin, ($conf[0] * $i), $conf[0]);
            $level = substr($_item, 0, 1);
            $level2 = substr($_item, 1, 1);
            $level3 = substr($_item, 14, 2);
            $level1 = hexdec(substr($level, 0, 1));
            if (($level1 % 2) <> 0) {
                $level2 = "1" . $level2;
                $level1--;
            }
            if (hexdec($level3) >= 128) {
                $level1 += 16;
            }
            $level1 /= 2;
            $id = hexdec($level2);

            $result = mssql_query("select [x],[y],[Name] from [DTweb_JewelDeposit_Items] where [id]={$id} and [type]={$level1}");
            $res = mssql_fetch_array($result);


            $y = 0;
            while ($y < $res['y']) {
                $y++;
                $x = 0;
                while ($x < $res['x']) {
                    $items = substr_replace($items, '1', ($i + $x) + (($y - 1) * 8), 1);
                    $x++;
                }
            }
            $i++;
        }
        $y = 0;
        while ($y < $itemY) {
            $y++;
            $x = 0;
            while ($x < $itemX) {
                $x++;
                $spacerq[$x + (8 * ($y - 1))] = true;
            }
        }
        $walked = 0;
        $i = 0;
        while ($i < 120) {
            if (isset($spacerq[$i])) {
                $itemsm = substr_replace($itemsm, '0', $i - 1, 1);
                $last = $i;
                $walked++;
            }
            if ($walked == count($spacerq)) {
                $i = 119;
            }
            $i++;
        }
        $useforlength = substr($itemsm, 0, $last);
        $findslotlikethis = '^' . str_replace('++', '+', str_replace('1', '+[0-1]+', $useforlength));
        $i = 0;
        $nx = 0;
        $ny = 0;
        while ($i < 120) {
            if ($nx == 8) {
                $ny++;
                $nx = 0;
            }
            if ((preg_match("/{$findslotlikethis}/", substr($items, $i, strlen($useforlength)))) && ($itemX + $nx < 9) && ($itemY + $ny < 16)) {
                return $i;
            }
            $i++;
            $nx++;
        }
        return 1337;
    }

    public function betRenas($count) {
	    if(isset($_SESSION['lang'])){
			require $_SERVER['DOCUMENT_ROOT']."/lang/".$_SESSION['lang'].".php";
		}
		else{
			require $_SERVER['DOCUMENT_ROOT']."/lang/en.php";
		}
		$check_opt = mssql_fetch_array(mssql_query("Select * from DTweb_Auction_Settings"));
        if ($count > 0) {
            if ($count > User::getInstance()->updateRenas()) {
				
                echo "<span class='error'>".phrase_not_enough . $check_opt['column']."!</span>";
            } else {
				require $_SERVER['DOCUMENT_ROOT']."/configs/config.php";
				if($check_opt['column'] == "credits"){
					$table    = $option['cr_db_table'];
					$tbl_user = $option['cr_db_check_by'];
					$column   = $option['cr_db_column'];
				}	
				else{
					$table    = $check_opt['table'];
					$tbl_user = $check_opt['user'] ;
					$column   = $check_opt['column'];
				}
                $chk = Database::$inst->q("Select * from [DTweb_Auction_Bets] Where [auction_id]={$this->auction_id} and [user]='" . User::$inst->getUser() . "'", 1);
                Database::$inst->q("Update [".$table."] Set [".$column."]=[".$column."]-{$count} Where [".$tbl_user."]='" . User::$inst->getUser() . "'");

                if ($chk == 1) {
                    Database::$inst->q("Update [DTweb_Auction_Bets] Set ip='".$this->ip()."',time='".time()."',[count]=[count]+{$count} Where [auction_id]={$this->auction_id} and [user]='" . User::$inst->getUser() . "'");
                } else {
                    Database::$inst->q("INSERT INTO [DTweb_Auction_Bets] ([auction_id], [user], [count],[ip],[time],[resource]) VALUES ({$this->auction_id}, '" . User::$inst->getUser() . "', {$count},'".$this->ip()."','".time()."','".$column."')");
                }

                echo "<span class='success'>".phrase_you_have_bet .$count . "&nbsp;".$column."!</span>";
            }
        } else {
            echo "<span class='error'> ".phrase_must_bet_at_least .$column."!</span>";
        }
    }

    public function getTime() {



        return $this->time - time();
    }

    /**
     * 
     * @return Auction
     */
    public static function getInstance() {
        if (self::$inst == null) {
            self::$inst = new Auction();
        }

        return self::$inst;
    }

}
}