<?php
require $_SERVER['DOCUMENT_ROOT']."/inc/iteminfouser.php";
$check_opt = mssql_fetch_array(mssql_query("Select * from DTweb_Auction_Settings"));
$lastauction = Database::$inst->q("Select [item] From [DTWeb_Auctions] order by [id] desc", 2);
$iinfo = Iteminfouser($lastauction['item']);

lang();
 
if(($_SESSION[$this->i_config->getWebConfig("user_session_name")]) != null):
?>
<table width="400" cellspacing="0" cellpadding="0" border="0" align="center" class="auctiontable">
    <tr>
        <td class="bottomauction"><?php echo phrase_current_auction ?></td>
    </tr>
    <tr>
        <td align="center">
            <div>
                <br /><img class="iteminfo" src="/<?php echo $iinfo['thumb'] ?>" title="<?php echo $iinfo['overlib'] ?>" style="max-width: 400px;" /><br /><br />
            </div>
            <b><?php echo phrase_time_left?></b>
            <div id="countdown"></div>
        </td>
    </tr>
</table>
<table width="400" cellspacing="0" cellpadding="0" border="0" align="center" class="auctiontable">
    <tr>
        <td class="bottomauction">
            <?php echo phrase_welcome?> <font color="#ffffff"><?php echo $_SESSION[$this->i_config->getWebConfig("user_session_name")] ?></font>! -
            <?php echo phrase_you_have?> <span id="renas_count" style="color: #ffffff; font-weight: bold;"><?php echo User::getInstance()->updateRenas() ?></span> <?php echo $check_opt['column'];?>! - 
       
        </td>
    </tr>
    <tr>
        <td class="tdall">
            <br />
            <form>
                <input type="text" id="batvalue" maxlength="5" />
                <input type="submit" value="<?php echo phrase_bet?>!" id="bet" />
            </form>
            <div id="bet_response"></div>
        </td>
    </tr>
</table>
<div id="bets"></div>
<table width="350" cellspacing="0" cellpadding="0" border="0" align="center" class="auctiontable">
    <tr>
        <td class="bottomauction">
            <a href="#show" onclick="$('#previous').slideToggle(1000); return false;"><?php echo phrase_last_auctions?></a>
        </td>
    </tr>
    <tr>
        <td class="tdall">
            <div id="previous" style="display: none;">
                <table align="center">
                    <tr>
                        <?php
                        $query = $this->i_database->q("Select TOP 10 * From [DTWeb_Auctions]  where [winner] IS NOT NULL order by [id] desc");

                        while ($r = $this->i_database->fa($query)) {
                            //TODO
                            $count = $this->i_database->q("Select [count],[resource] From [DTweb_Auction_Bets] Where [user]='{$r['winner']}' and [auction_id]='{$r['id']}'", 2);
							$hiden_user = mssql_fetch_array(mssql_query("Select * from [AccountCharacter] where [id] = '{$r['winner']}'"));
                            $iinfo = Iteminfouser($r['item']);
                            $i++;
                            echo '<td valign="top">
                                    <table align="center" class="top" width="215">
                                        <tr>
                                            <td class="toptd">'.phrase_winner.'</td>
                                            <td class="toptd">'.phrase_bet.'</td>
                                            <td class="toptd">'.phrase_item.'</td>
                                        </tr>
                                        <tr>
                                            <td><font color="#FF0000">' . $hiden_user['GameIDC'] . '</font></td>
                                            <td><font color="#f0f0e1">' . $count['count'] .'&nbsp;'.$count['resource'].'</font></td>
                                            <td class="iteminfo" title="' . $iinfo['overlib'] . '" width="70">
                                                <img height="32" src="/' . $iinfo['thumb'] . '" style="max-width: 64px;" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>';

                            if ($i % 2 == 0) {
                                echo "</tr><tr>";
                            }
                        }
                        ?>
                </table>
            </div>
        </td>
    </tr>
</table>
<?php else: ?>
<div style="text-align:center;"> <?php echo phrase_need_login_to_bet?></div>
<table width="400" cellspacing="0" cellpadding="0" border="0" align="center" class="auctiontable">
    <tr>
        <td class="bottomauction"><?php echo phrase_current_auction ?></td>
    </tr>
    <tr>
        <td align="center">
            <div>
                <br /><img class="iteminfo" src="/<?php echo $iinfo['thumb'] ?>" title="<?php echo$iinfo['overlib'] ?>" style="max-width: 400px;" /><br /><br />
            </div>
            <b><?php echo phrase_time_left?>:</b>
            <div id="countdown"></div>
        </td>
    </tr>
</table>
<table width="350" cellspacing="0" cellpadding="0" border="0" align="center" class="auctiontable">
    <tr>
        <td class="bottomauction">
            <a href="#show" onclick="$('#previous').slideToggle(1000); return false;"><?php echo phrase_last_auctions?></a>
        </td>
    </tr>
    <tr>
        <td class="tdall">
            <div id="previous" style="display: none;">
                <table align="center">
                    <tr>
                        <?php
                        $query = $this->i_database->q("Select TOP 10 * From [DTWeb_Auctions] Where [winner] IS NOT NULL order by [id] desc");

                        while ($r = $this->i_database->fa($query)) {
                            //TODO
                            $count = $this->i_database->q("Select [count] From [DTweb_Auction_Bets] Where [user]='{$r['winner']}' and [auction_id]={$r['id']}", 2);
                            $iinfo = Iteminfouser($r['item']);
                            $i++;
                            echo '<td valign="top">
                                    <table align="center" class="top" width="215">
                                        <tr>
                                            <td class="toptd">'.phrase_winner.'</td>
                                            <td class="toptd">'.phrase_bet.'</td>
                                            <td class="toptd">'.phrase_item.'</td>
                                        </tr>
                                        <tr>
                                            <td><font color="#FF0000">' . $r['winner'] . '</font></td>
                                            <td><font color="#00FF00">' . $count['count'] . '</font></td>
                                            <td class="iteminfo" title="' . $iinfo['overlib'] . '" width="70">
                                                <img height="32" src="/' . $iinfo['thumb'] . '" style="max-width: 64px;" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>';

                            if ($i % 2 == 0) {
                                echo "</tr><tr>";
                            }
                        }
                        ?>
					
                </table>
            </div>
        </td>
    </tr>
</table>

<?php endif;?>
