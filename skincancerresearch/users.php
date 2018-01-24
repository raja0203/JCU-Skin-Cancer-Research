<?php
session_start();
include_once('config.php');
if(!$_SESSION[isadmin]) header("Location: login.php");

$sql = "Select * from user_details order by userid desc";
$conn -> query($sql);
$result = $conn->query($sql);
echo $conn->error;
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()){
    $users[] = $row;
  }
}

?>

 <html>
     <head>
         <title>
             Submitted Bluecards
         </title>
     </head>
 <body>
 <?php
 include_once('menu.php');
 ?>
 <div align="" style="margin:auto;padding:0;" class="content">
   <?php if($out) echo '<div class="alert alert-success">'.$out.'</div>'; ?>
 	  <h1>Submitted Bluecards</h1>

    <?php
      if($users){
        echo "<table class='question-list' >";
        echo "<tr><th>ID</th><th>Account Created</th><th>Name</th><th>Email</th><th>Username</th><th>BlueCard details</th><th>User Status</th><th>Uploaded files</th></tr>";
        foreach($users as $u){
          echo "<tr>
                <td>".$u[userid]."</td>
                <td>".$u[account_created_time]."</td>
                <td>".$u['first_name']." ".$u[last_name]."</td>
                <td>".$u['email']."</td>
                <td>".$u['username']."</td>
                <td><b>Name: </b>".$u['blue_card_name']."<br>
                    <b>Card Number: </b>".$u[card_number]."<br>
                    <b>Issue Number: </b>".$u[issue_number]."<br>
                    <b>Expiry Date: </b>".$u[expiry_date]."
                </td>
                <td>".$u['blue_card_status']."</td>
                <td>".
                (($u['bluecard_application_file'])?"<a href='$u[bluecard_application_file]'>Bluecard application file</a><br>":"").
                (($u['confirmation_of_identity_file'])?"<a href='$u[confirmation_of_identity_file]'>Confirmation of identity file</a><br>":"").
                (($u['alternative_identification_file'])?"<a href='$u[alternative_identification_file]'>Alternative identification file</a>":"")
                ."</td>
                </tr>";
        }
        echo "</table>";
      }

    ?>

 </div>
 <!--This code is used for changing the active item on the menu-->
 <script>
 $(document).ready(function(){
 //$('#faq').addClass("active");
 });
 </script>
 <!-- The above code is used to change the active item on the menu. To be explicitly pasted on each page that is created-->
 </body>
 </html>
