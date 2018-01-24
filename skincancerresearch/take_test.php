<?php
session_start();
include_once('config.php');

if(!$_SESSION[userid]) header("Location: login.php");

//print_r($_SESSION);
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(!isset($_SESSION[attempted_questions])){
  $_SESSION['attempted_questions'][]=0;
  $_SESSION['correct_answers']=0;
  $_SESSION['incorrect_answers']=0;
  $_SESSION['total_answers']=0;
}

if($_POST){
  $question_id = intval($_POST['question_id']);
  $_SESSION['attempted_questions'][] = $question_id ;
  $sql = "select * from quiz where id = $question_id ";
  $result = $conn -> query($sql);
  echo $conn->error;
  if ($result->num_rows > 0) {
  	$row = $result->fetch_assoc();
    $_SESSION[is_last_easy] = $row[is_easy];
    if(
      $_POST[children_sunsafe] == $row[children_sunsafe] and
      $_POST[children_other] == $row[children_other] and
      $_POST[children_no] == $row[children_no] and
      $_POST[adults_sunsafe] == $row[adults_sunsafe] and
      $_POST[adults_other] == $row[adults_other] and
      $_POST[adults_no] == $row[adults_no]
    )
        $_SESSION['correct_answers']++;
    else
        $_SESSION['incorrect_answers']++;

    $_SESSION['total_answers'] = $_SESSION['correct_answers']+$_SESSION['incorrect_answers'];

    if($_SESSION['correct_answers']==3){

      $appDownloadCode = generateRandomString();
      $sql = "update user_details set blue_card_status = 'test_passed', appDownloadCode='$appDownloadCode' where userid = $_SESSION[userid] ";
      $conn -> query($sql);
      if($conn->error) die($conn->error);

      mail($_SESSION['email'],"Instructions to download app."," Hi $_SESSION[username]
        Please go to http://skincancerresearch.jcubitgroup.com/download_app.php?userid=".$_SESSION[userid]." and put code $appDownloadCode to download the app.

        In order to use this app on your Android Device(Smartphone or tablet), please open the link in your device's browser. Alternatively, if you can access your
        email on your smartphone or tablet, clicking on the link above will ensure it automatically downloads ready for installation once you have entered the unique
        code provided above.
        Instructions on how to install and use the app can be found at  http://skincancerresearch.jcubitgroup.com/files/Hat-wearing-observation-users-guide.docx ");

      header("location: user-status.php");
      die();
    }

    if($_SESSION['total_answers']==5){
      $sql = "update user_details set blue_card_status = 'test_failed' where userid = $_SESSION[userid] ";
      $conn -> query($sql);
      if($conn->error) die($conn->error);
      unset($_SESSION[attempted_questions]);
      header("location: user-status.php");
      die();
    }
    header("location: take_test.php");
    die();
  }

}


if(!isset($_SESSION[is_last_easy])) $_SESSION[is_last_easy] = 0;
$sql = "Select * from quiz where id not in (".implode(",",$_SESSION['attempted_questions']).") and is_easy not like $_SESSION[is_last_easy] ";
$conn -> query($sql);
$result = $conn->query($sql);
echo $conn->error;
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()){
    $question_ids[$row[id]] = $row[id];

    $questions[$row[id]] = $row;
  }
  $selected_question_id = array_rand($question_ids);
  $selected_question = $questions[$selected_question_id];
  //print_r($selected_question);
}

?>

 <html>
     <head>
         <title>
             Manage Quiz
         </title>
     </head>
 <body>
 <?php
 include_once('menu.php');
 ?>
 <div align="" style="margin:auto" class="content">


    <div class="jumbotron" id="question_form_div" style="padding-top: 0">
      <form action="" method="post" enctype="multipart/form-data" class=" text-left" style="padding:2px 20px; margin-top: 30px;">
        <input type="hidden" name="question_id" value="<?php echo $selected_question[id]; ?>">
        <h1>Question #<?php echo ($_SESSION['total_answers']+1); ?></h1>
        <p>Please fill in the following table using the following image</p>
        <div>
            <div ><?php echo '<img id="question_img"  src="'.$selected_question[file].'"/>' ?>
        </div>

        <table>
          <tr>
            <th> &nbsp;</th>
            <th> Sun Safe Hats</th>
            <th> Other Hats</th>
            <th> No Hats</th>
          </tr>
          <tr>
            <th> Children</th>
            <td><input type="number" name="children_sunsafe" value="" required class="answer" /></td>
            <td><input type="number" name="children_other" value="" required  class="answer"/></td>
            <td><input type="number" name="children_no" value="" required class="answer" /></td>
          </tr>
          <tr>
            <th> Adults</th>
            <td><input type="number" name="adults_sunsafe" value="" required class="answer" /></td>
            <td><input type="number" name="adults_other" value="" required  class="answer"/></td>
            <td><input type="number" name="adults_no" value="" required  class="answer"/></td>
          </tr>
        </table>

        <div style="padding-left: 10px; ">
            <input type="submit" value="Submit" class="" style="">
        </div>

      </form>
    </div>
 </div>
 <!--This code is used for changing the active item on the menu-->
 <script>
 $(document).ready(function(){
   $('#faq').addClass("active");
   <!--toggleImgSize($('#question_img'));-->

   $('.answer').on("keyup change", function(){
     if($(this).val()==""){
       $(this).css("background-color", "");
     }
     else{
       var name = $(this).attr("name");
       var answers = {
         children_sunsafe:<?php echo $selected_question[children_sunsafe]; ?>,
         children_other:<?php echo $selected_question[children_other]; ?>,
         children_no:<?php echo $selected_question[children_no]; ?>,
         adults_sunsafe:<?php echo $selected_question[adults_sunsafe]; ?>,
         adults_other:<?php echo $selected_question[adults_other]; ?>,
         adults_no:<?php echo $selected_question[adults_no]; ?>
       };

       if(answers[name]==$(this).val()){
         $(this).css("background-color", "#dff0d8");
       }
       else {
         $(this).css("background-color", "#f2dede");
       }
     }
   });

  //  $('#question_img').on("click", function(){
  //    toggleImgSize($('#question_img'));
  //  });
  // function toggleImgSize(el){
  //   if(!el.hasClass('minimized')){
  //     el.width("400px");
  //     el.css( 'cursor', '-webkit-zoom-in' );
  //     el.addClass("minimized");
  //   }
  //   else{
  //     el.width("auto");
  //     el.css( 'cursor', '-webkit-zoom-out' );
  //     el.removeClass("minimized");
  //   }
  // }
 });
 </script>
 <!-- The above code is used to change the active item on the menu. To be explicitly pasted on each page that is created-->
 </body>
 </html>
