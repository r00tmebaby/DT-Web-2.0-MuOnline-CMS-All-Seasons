 <script type="text/javascript" src="../js/easyTooltip.js"></script>
<script type="text/javascript" src="../js/ajax.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){	
			$("[title]").easyTooltip();
		});
	</script>
 <?php 

if(isset($_POST['search'])){
 include("../configs/config.php") ;
 include("../inc/sqlcfg.php") ;
 $name = clean_post(trim($_POST["search"]));
 $output = ''; 
 $sql = mssql_query("SELECT * FROM Character WHERE Name LIKE '%".$name."%' or AccountID like '%".$name."%'");
   
 if(mssql_num_rows($sql) > 0)  
 {   
      $output .= '  <table style="margin:0 auto;position:absolute;" border="1" cellpadding="2" width="225">  
                                <tr class="title">  
                                    <td align="center">Account</td>  
                                    <td align="center">Character</td>   
                                </tr>';  
      while($row = mssql_fetch_array($sql))  
      {    
           $output .= '  
                <tr>  
					  <td align="center"><a href="?p=bans&type=1&acc='.$row["AccountID"].'">'.$row["AccountID"].'</a></td>
                      <td align="center"><a href="?p=bans&type=2&char='.$row["Name"].'">'.$row["Name"].'</a></td>
                </tr>  
           ';  
      }  
 }  
 else  
 {  
      $output .= '<div class="error">Data Not Found</div>';  
 } 
}
else{
	 $output .= '<div class="error">Please select type</div>'; 
}
echo "</table><div class='render'>{$output}</div>";  

 ?> 
