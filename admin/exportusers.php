<?php
include_once "class/config.php";
$db=Database::getInstance();
$link=$db->getConnection();
$query="SELECT  t1.name as `Name` ,  t1.mobile as `Mobile`, t1.email  as `Email`,
		CONCAT(t2.`address`, ',' , t2.`landmark`, ',' , t2.`postoffice`, ',', t2.`district`, ',' , t2.`state` , '-' , t2.`pincode`) as `Address`
		from tbl_member t1, tbl_orders t2, tbl_address t3 where t1.id=t2.user_id and t1.id=t3.user_id group by t2.user_id";
$result=@mysqli_query($link,$query) or die("Couldn't execute query:<br>" . mysqli_error($link));  
$filename="Users-Report-".date('dmY');
$file_ending = "xls";
//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
$fieldinfo=mysqli_fetch_fields($result);
  foreach ($fieldinfo as $val)
    {
    printf($val->name . "\t");
    }
//for ($i = 0; $i < mysqli_num_fields($result); $i++) {
//echo mysqli_fetch_fields($result,$i) . "\t";
//}
print("\n");    
//end of printing column names  
//start while loop to get data
	$i=1;
    while($row = mysqli_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysqli_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    } 
	
?>