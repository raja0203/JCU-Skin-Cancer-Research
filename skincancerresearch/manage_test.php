<?php
session_start();
include_once('config.php');

if(!$_SESSION[isadmin]) header("Location: login.php");

$id = intval($_GET[id]);

if($_POST){
  if($id){ // edit existing quiz
    $sql = "update quiz set children_sunsafe = ".intval($_POST[children_sunsafe]).", children_other = 
    		".intval($_POST[children_other]).", children_no= ".intval($_POST[children_no]).", adults_sunsafe = ".intval($_POST[adults_sunsafe]).", 
    		adults_other = ".intval($_POST[adults_other]).", adults_no= ".intval($_POST[adults_no]).", 
    		is_easy=".intval($_POST[is_easy])." where id = $id";
    $conn -> query($sql);
    echo $conn->error;
  }
  else{ // new entry
    $sql = "insert INTO quiz values('','',".intval($_POST[children_sunsafe]).", ".intval($_POST[children_other]).", ".intval($_POST[children_no]).", ".intval($_POST[adults_sunsafe]).", ".intval($_POST[adults_other]).", ".intval($_POST[adults_no]).", ".intval($_POST[is_easy]).")";
    $conn -> query($sql);
    $id = $conn->insert_id;
    echo $conn->error;
  }
  if(!$conn->error)
    $out = "Question updated. ";

  $target_dir = "quiz_files/";
  $file_name = basename($_FILES["file"]["name"]);
  if($file_name){
    $save_url = $id.'-'.preg_replace("/[^a-zA-Z0-9 \.]+/", "", $file_name);
    $target_file = $target_dir.$save_url;
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $sql = "update quiz set file = '".$conn->real_escape_string($target_file)."' where id = $id ";
        if($conn->query($sql)){
          $out.="<br>File uploaded successfully";
        }
        else{
          $uploaded = false;
          die($conn->error);
        }
    }
    else {
      $error =  "Sorry, there was an error uploading your file.";
    }
  }
}



if($_GET[id]){ // get data of selected question
  $sql = "Select * from quiz where id = $id ";
  $conn -> query($sql);
  $result = $conn->query($sql);
  echo $conn->error;
  if ($result->num_rows > 0) {
  	$row = $result->fetch_assoc();
    $file = $row['file'];
    $children_sunsafe = $row[children_sunsafe];
    $children_other= $row[children_other];
    $children_no = $row[children_no];
    $adults_sunsafe = $row[adults_sunsafe];
    $adults_other = $row[adults_other];
    $adults_no = $row[adults_no];
    $is_easy = $row[is_easy];
  }
}
else{// Get all questions in the quiz
  $sql = "Select * from quiz";
  $conn -> query($sql);
  $result = $conn->query($sql);
  echo $conn->error;
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
      $questions[] = $row;
    }
  }
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
   <?php if($out) echo '<div class="alert alert-success">Files uploaded successfully</div>'; ?>
 	  <h1>Manage quiz <a class="btn btn-primary">+ Add questions </a></h1>

    <?php
      if($questions){
        echo "<div>Questions </div>";
        echo "<table class='question-list' >";
        echo "<tr><th>ID</th><th>Is easy?</th><th>Image</th><th>Answers</th></tr>";
        foreach($questions as $q){
          echo "<tr style='padding-top:20px;'>
                <th>".$q[id]."<br> <a href='?id=$q[id]'>Edit</a></th>
                <th>".(($q[is_easy])?"Yes":"No")."</th>
                <th>".'<img width="200" src="'.$q['file'].'"/></th>';

          echo '<td>';
           ?>

          <table style="padding-left: 20px;">
            <tr>
              <th> &nbsp;</th>
              <th> Sun Safe Hats</th>
              <th> Other Hats</th>
              <th> No Hats</th>
            </tr>
            <tr>
              <th> Children</th>
              <td><?php echo $q[children_sunsafe]; ?></td>
              <td><?php echo $q[children_other]; ?></td>
              <td><?php echo $q[children_no]; ?></td>
            </tr>
            <tr>
              <th> Adults</th>
              <td><?php echo $q[adults_sunsafe]; ?></td>
              <td><?php echo $q[adults_other]; ?></td>
              <td><?php echo $q[adults_no]; ?></td>
            </tr>
          </table>

    <?php
          echo '</td>';
          echo '</tr>';
        }
        echo "</table>";
      }

    ?>

    <div class="jumbotron" id="question_form_div" style="padding-top: 0">
      <form action="" method="post" enctype="multipart/form-data" class=" text-left" style="padding:2px 20px; margin-top: 30px;">
        <h2><?php if($id) echo "Edit Question #".$id; else echo "Add question"; ?></h2>
        <div>
            <div >Image: <?php if($file ) echo '<img width="400" src="'.$file.'"/>' ?>
            <span style="padding-left: 10px; padding-bottom: 20px;"><input type="file" name="file"></span></div>
        </div>

        <div>
            <div >This question is
              <input type="radio" name="is_easy" value="1" <?php if($is_easy==1) echo 'checked'; ?> /> Easy
              <input type="radio" name="is_easy" value="0" <?php if($is_easy==0) echo 'checked'; ?> /> Hard 
            </div>
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
            <td><input type="number" name="children_sunsafe" value="<?php echo $children_sunsafe; ?>" /></td>
            <td><input type="number" name="children_other" value="<?php echo $children_other; ?>" /></td>
            <td><input type="number" name="children_no" value="<?php echo $children_no; ?>" /></td>
          </tr>
          <tr>
            <th> Adults</th>
            <td><input type="number" name="adults_sunsafe" value="<?php echo $adults_sunsafe; ?>" /></td>
            <td><input type="number" name="adults_other" value="<?php echo $adults_other; ?>" /></td>
            <td><input type="number" name="adults_no" value="<?php echo $adults_no; ?>" /></td>
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
 });
 </script>
 <!-- The above code is used to change the active item on the menu. To be explicitly pasted on each page that is created-->
 </body>
 </html>
