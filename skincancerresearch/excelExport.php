<?php
include('config.php');
$sql = "select * from observation_details";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$header = '';

for ($i = 0; $i < $count; $i++){
   $header .= mysql_field_name($result, $i)."\t";
   }

while($row = $result->fetch_assoc()){
   $line = '';
   foreach($row as $value){
          if(!isset($value) || $value == ""){
                 $value = "\t";
          }else{
                 $value = str_replace('"', '""', $value);
                 $value = '"' . $value . '"' . "\t";
                 }
          $line .= $value;
          }
   $data .= trim($line)."\n";
   $data = str_replace("\r", "", $data);

if ($data == "") {
   $data = "\nno matching records found\n";
   }
}
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: attachment; filename=exportfile.xls");
header("Pragma: no-cache");
header("Expires: 0");

// output data
echo $header."\n".$data;
$conn->close();
?>