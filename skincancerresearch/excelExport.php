<?php
include('config.php');
$sql = "select * from observation_details";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$header = 'Observation ID '."\t".'User ID'."\t".'School Name'."\t".'School Postcode'."\t".'Season'."\t".'Rain'."\t".'Cloud Cover'."\t".'School Ownership'."\t".'School Setting'."\t".'School Type'."\t".'Time of Day'."\t".'Students with Sun safe hat'."\t".'Other Children with Sun safe hat'."\t".'Adults with Sun safe hat'."\t".'Students without Sun safe hat'."\t".'Other Children without Sun safe hat'."\t".'Adults without Sun safe hat'."\t".'Students with other Sun safe hat'."\t".'Other Children with other Sun safe hat'."\t".'Adults with other Sun safe hat'."\t".'date'."\t".'Start Time'."\t".'End Time';


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
$conn->close();
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: attachment; filename=user-observations.xls");
header("Pragma: no-cache");
header("Expires: 0");

// output data
echo $header."\n".$data;
?>