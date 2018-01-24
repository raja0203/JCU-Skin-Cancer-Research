<?php
session_start();
include_once('config.php');


$sql = "Select blue_card_status from user_details where userid = $_SESSION[userid] ";
$conn -> query($sql);
$result = $conn->query($sql);
echo $conn->error;
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$status = $row[blue_card_status];
}


?>

<html>
    <head>
        <title>
            User Status
        </title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
<body>
<?php
include_once('menu.php');
?>
<div style="margin:auto" class="content">

	<div class="col-md-1 col-md-push-1 text-center" id="have-card">
		<table>
			<form action="userObservation.php" method="post">
				<tr>
					<td style="padding:5px;">
						<input type="date" name="date" id="date" />
					</td>
					<td style="padding:5px;">
						<input type="submit" value="Go">
					</td>
				</tr>
			</form>
		</table>
	   <?php
	   $conn = db_connect();
	   
	   $sql = "select Obs_id,first_name, (std_withhat + children_withhat + adult_withhat), (std_withouthat + children_withouthat + adult_withouthat), (std_withotherhat + children_withotherhat + adult_withotherhat)";
	   $result= $conn -> query($sql);
	   
	   print "<table border=1>\n";
	   
	   print"<tr>\n";
	   while ($field = $result ->fetch_feild())
	   {
		   print "<th" .strtoupper($field->name) . "</th>\n)";
	   }
	   print "</tr>\n\n>";
	   
	   while ($row = $result -> fetch_assoc_assoc())
	   {
		   print"<tr>\n";
		   
		   foreach($row as $col=>$val)
		   {
			   print "<td>$val</td>\n";
		   }
		   print "</tr>\n\n>";
	   }
	   print "</table>\n";
	   $conn -> close();
	   ?>
		
	</div>
	<div class="clear-both"></div>


</div>
<!--This code is used for changing the active item on the menu-->
<script>
$(document).ready(function(){
	$('#bluecard').addClass("active");
});
</script>
<!-- The above code is used to change the active item on the menu. To be explicitly pasted on each page that is created-->
</body>
</html>
