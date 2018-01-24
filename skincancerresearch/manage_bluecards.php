<?php
session_start();
include_once('config.php');
if(!$_SESSION[isadmin]) header("Location: login.php");
$approve = intval($_GET[approve]);
$reject = intval($_GET[reject]);

if($approve or $reject){
  $sql = "Select * from user_details where userid = ".($approve+$reject);
  $conn -> query($sql);
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $user_email = $row['email'];
}

if($approve){
    $sql = "update user_details set blue_card_status = 'approved' where userid = $approve ";
    $conn -> query($sql);
    echo $conn->error;
    mail($user_email,"Your bluecard has been verified"," Hi $row[first_name] $row[last_name], Please login with your username ".$row[username]." at http://skincancerresearch.jcubitgroup.com/login.php to take test and download the app. ");
    $out = "Bluecard Accepted and user notified";
}
if($reject){
    $sql = "update user_details set blue_card_status = 'rejected' where userid = $reject ";
    $conn -> query($sql);
    echo $conn->error;
    mail($user_email,"There was some problem with your bluecard"," Hi $row[first_name] $row[last_name], I wasn't able to verify your bluecard - perhaps some details were entered wrong. Please login with your username ".$row[username]." at http://skincancerresearch.jcubitgroup.com/login.php to try again. ");
    $out = "Bluecard reject and user notified";
}

$sql = "Select * from user_details where blue_card_status='submitted' order by updated_time desc";
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
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Username</th><th>BlueCard details</th><th>Bluecard Status</th><th>Action</th></tr>";
        foreach($users as $u){
          echo "<tr>
                <td>".$u[userid]."</td>
                <td>".$u['first_name']." ".$u[last_name]."</td>
                <td>".$u['email']."</td>
                <td>".$u['username']."</td>
                <td><b>Name: </b>".$u['blue_card_name']."<br>
                    <b>Card Number: </b>".$u[card_number]."<br>
                    <b>Issue Number: </b>".$u[issue_number]."<br>
                    <b>Expiry Date: </b>".$u[expiry_date]."
                </td>
                <td>".$u['blue_card_status']."</td>
                <td><a href='?reject=".$u[userid]."'>Reject</a> | <a href='?approve=".$u[userid]."'>Approve</a> </td>
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
