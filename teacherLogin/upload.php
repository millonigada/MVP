<?php 
  require_once "../connections.php";
  session_start();
  //unset($_SESSION["success"]);

  // if(isset($_SESSION['account']))
  // {
  //   unset($_SESSION['success']);
  //   $teachID=$_SESSION['accountID'];
  //   //echo $teachID;
  //   $getContentModuleIDQuery = "SELECT Module_ID FROM content";
  //   $getContentModuleID = $pdo->query($getContentModuleIDQuery);
  //   $existingModules = array();
  //   while($row = $getContentModuleID->fetch(PDO::FETCH_ASSOC))
  //   {
  //     array_push($existingModules, $row['Module_ID']);
  //   }

  //   print_r($existingModules);

  //   $getSubjectTeacherQuery = "SELECT * FROM join_subject_teacher WHERE Teach_ID = ".$teachID;
  //   $getSubjectTeacher = $pdo->query($getSubjectTeacherQuery);
  //   $mySubjects = array();
  //   while($row = $getSubjectTeacher->fetch(PDO::FETCH_ASSOC))
  //   {
  //     array_push($mySubjects, $row['Subject_ID']);
  //   }

  //   print_r($mySubjects);
  // }

    //$teachID=$_SESSION['accountID'];
    if(isset($_GET['ID'])&&isset($_GET['Name']))
    {  
      $teachID=$_GET['ID'];
      $teachName=$_GET['Name'];
    }
    else if(isset($_POST['ID'])&&isset($_POST['Name']))
    {
      $teachID=$_POST['ID'];
      $teachName=$_POST['Name'];
    }
    else
    {
      echo "Please <a href='login.php'>login</a> first";
    }
    //echo $teachID;
    $getContentModuleIDQuery = "SELECT Module_ID FROM content";
    $getContentModuleID = $pdo->query($getContentModuleIDQuery);
    $existingModules = array();
    while($row = $getContentModuleID->fetch(PDO::FETCH_ASSOC))
    {
      array_push($existingModules, $row['Module_ID']);
    }

    //print_r($existingModules);

    $getSubjectTeacherQuery = "SELECT * FROM join_subject_teacher WHERE Teach_ID = ".$teachID;
    $getSubjectTeacher = $pdo->query($getSubjectTeacherQuery);
    $mySubjects = array();
    while($row = $getSubjectTeacher->fetch(PDO::FETCH_ASSOC))
    {
      array_push($mySubjects, $row['Subject_ID']);
    }

    //print_r($mySubjects);

  if(isset($_POST['upload']))
  {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    if($fileActualExt == 'pdf')
    {
      if($fileError === 0)
      {
        if($fileSize<5000000)
        {
          $fileDestination = '../notes/'.$fileName;
          move_uploaded_file($fileTmpName, $fileDestination);

          $insertIntoContentQuery="INSERT INTO content (Content_Location, Content_Description, Content_Type_ID, Module_ID, Teach_ID) VALUES (:contentLocation, :contentDescription, :contentTypeID, :moduleID, :teachID)";
          $insertIntoContent = $pdo->prepare($insertIntoContentQuery);
          $insertIntoContent->execute(array(
            
            'contentLocation' => $fileName,
            'contentDescription' => $_POST['contentDescription'],
            'contentTypeID' => 1,
            'moduleID' => $_POST['selectModule'],
            ':teachID' => $teachID,));
          
          echo "Upload success";
          header('Location: upload.php?ID='.$teachID.'&Name='.$teachName);
        }
        else
        {
          echo "This file is too large. Please make sure its 5MB or less.";
        }
      }
      else
      {
        echo "There was an error while uploading this file.";
      }
    }
    else
    {
      echo "Please upload a pdf file";
    }
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MVP Home</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css/indexstyle.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
  <style>
    h1{
  color: rgb(212,175,55);
  font-family: Nunito;
  font-weight: 300;
    }

    h3{
  color: rgb(219,100,0);
  font-family: Nunito;
  font-weight: 300;
    }

    p{
  color: rgb(255,255,255);
  font-family: "Monaco", monospace;
  font-size: 20px;
  font-weight: 200;
    }

    .upload-buttons{
      padding: 4px;
      background-color: rgb(212,175,55);
      font-size: 16px;
      border-radius: 8px;
      color: black;
      border: 2px solid rgb(219,100,0); 
    }

    label{
      color: white;
    }
  </style>

</head>

<body background="https://cdn.wallpapersafari.com/33/16/gaI3sU.jpg">

      <div class="container-fluid">
        <?php 

          echo ("<h1>Welcome, ".$teachName."</h1>");

        ?>
        <div style="border: groove; border-radius: 25px; padding: 10px">
        <h3>Previously uploaded notes:</h3><br>
        <?php
          $getContentQuery = "SELECT Content_Location FROM content WHERE Teach_ID =".$teachID;
          $getContent = $pdo->query($getContentQuery);
          while ($row = $getContent->fetch(PDO::FETCH_ASSOC)) {
            echo ("<p>".$row['Content_Location']."</p>");
          }
        ?>
      </div>
      <br>
        <h3>Upload notes here</h3>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
          <label for="selectModule" style="color: white">Choose a Module:</label>
          <select name="selectModule">
            <?php
              $getModuleQuery = "SELECT * FROM module";
              $getModule = $pdo->query($getModuleQuery);
              $allModules = array();
              $availableModules = array();
              while($row = $getModule->fetch(PDO::FETCH_ASSOC))
              {
                array_push($allModules, $row['Module_ID']);
              }

              while($row = $getModule->fetch(PDO::FETCH_ASSOC))
              {
                if(in_array($row['Subject_ID'],$mySubjects))
                {
                  if(!(in_array($row['Module_ID'], $existingModules)))
                  {
                    $availableModules[$row['Module_ID']] = $row['Module_Name'];
                  }
                }
              }
              // print_r($availableModules);

              foreach ($availableModules as $key => $value) {
                # code...
                echo ('<option value="'.$key.'">'.$value.'</option>');
              }
            ?>
            <option value="1">Introduction to Data Structures</option>
            <option value="2">Stack and Queues</option>
            <option value="3">Linked List</option>
            <option value="4">Trees</option>
            <option value="5">Graphs</option>
            <option value="6">Searching Techniques</option>
            <option value="1">Introduction and Overview of Graphics System</option>
            <option value="2">Output Primitives</option>
            <option value="3">Two Dimensional Geometric Transformations</option>
            <option value="4">Two-Dimensional Viewing and Clipping</option>
            <option value="5">Three Dimensional Geometric Transformations, Curves and Fractal Generation</option>
            <option value="6">Visible Surface Detection and Animation</option>
          </select>
          <br>
          <label for="contentDescription">Description:</label>
          <textarea name="contentDescription" cols="40"></textarea><br>
          <input class="upload-buttons" style="margin-top: 4px;" type="file" name="file"><br><br>
          <button class="upload-buttons" style="margin-top: 4px;" type="submit" name="upload">Upload</button>
          <input type="hidden" name="ID" value="<?php echo $teachID; ?>"/>
          <input type="hidden" name="Name" value="<?php echo $teachName; ?>"/>
        </form>
        <a href="logout.php">Logout</a>
      </div>

  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>