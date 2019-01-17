<?php 		
include_once ($_SERVER['DOCUMENT_ROOT']."/inc/modules_funcs.php");
lang();
?>
<table width="350" cellspacing="0" cellpadding="0" border="0" align="center" class="auctiontable">
                <tr>
                    <td class="bottomauction"><?php echo phrase_current_item_bets?></td>
                </tr>
                <tr>
                    <td class="tdall">
                        <br />
                        <table align="center" class="top" width="200">
                            <tr>
                                <td class="toptd"><?php echo phrase_number?></td>
                                <td class="toptd"><?php echo phrase_user?></td>
                                <td class="toptd"><?php echo phrase_bet?></td>
                            </tr>
                            <?php

                            $lastauction = Database::$inst->q("Select [id] From [DTWeb_Auctions] order by [id] desc", 2);
                            $lastbets = Database::$inst->q("Select * From [DTweb_Auction_Bets] Where [auction_id]={$lastauction['id']} order by [count] desc");
                            
                            while($r=  Database::$inst->fa($lastbets)){
                                $i++;
                                
                                if ($i == 1) {
                                    $color = "#FF0000";
                                } elseif ($i == 2 || $i == 3) {
                                    $color = "#CC9933";
                                } else {
                                    $color = "#FFFFFF";
                                }
                                
                                if($i <= 5){
                                    $rank = '<img src="template/images/top_' . $i . '.gif" alt="' . $i . '" />';
                                } else {
                                    $rank = '<small>' . $i . '</small>';
                                }
                                
                                echo '<tr>
                                    <td>' . $rank . '</td>
                                    <td><font color="' . $color . '">' . $r['user'] . '</font></td>
                                    <td><font color="#00FF00"><b>' . $r['count'] . '</b></font></td>
                                </tr>';
                            }
                            
                            if($i == 0){
                                echo "<tr><td colspan='3' align='left'>".phrase_no_bets_yet."</td></tr>";
                            }
                            
                            ?>
                        </table>
                    </td>
                </tr>
            </table>