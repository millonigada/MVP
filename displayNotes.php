<?php 
  require_once "connections.php";

  // $subjectID=1;

  // if(isset($_GET['subject']))
  // {
  //   $subjectID=$_GET['ID'];
  //   //echo $subjectID;
  // }

  // if(isset($_GET['subject'])&&isset($_GET['module']))
  // {
  //   $mID = $_GET['module'];
  //   $getContentQuery = "SELECT * FROM content WHERE Module_ID = ".$mID;
  //   $getContent = $pdo->query($getContentQuery);
  //   while($row = $getContent->fetch(PDO::FETCH_ASSOC))
  //   {
  //     echo ('<iframe class="mt-4" src="notes/'.$row['Content_Location'].'" style="width: 1200px; height: 1000px;" frameborder="0">');
  //     echo ('</iframe>');
  //   }
  // }

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
  <link href="css/MVP1.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/rstyle.css">
  <link href="css/indexstyle.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />

</head>

<body background="https://cdn.wallpapersafari.com/33/16/gaI3sU.jpg">

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading"><img src="img/MVP.png" alt="MVP Logo" height="50px"></div>
      <div class="list-group list-group-flush">
        <?php 

          $getSubjectQuery = "SELECT * FROM subject";
          $getSubject = $pdo->query($getSubjectQuery);
          while($row = $getSubject->fetch(PDO::FETCH_ASSOC))
          {
            $thisSubjectID = $row['Subject_ID'];
            $subjectName = $row['Subject_Name'];
            echo ('<a href="notes.php?subject='.$subjectName.'&ID='.$thisSubjectID.'" class="list-group-item list-group-item-action bg-light">');
            echo ($subjectName);
            echo ('</a>');
          }

        ?>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav navbar-left ml-auto mt-2 mt-lg-0">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item" id="menu-toggle"><a class="nav-link" href="#">Notes</a></li>
            <li class="nav-item"><a class="nav-link" href="resources.php">Resources</a></li>
            <li class="nav-item"><a class="nav-link" href="software.php">Software</a></li>
            <li class="nav-item"><a class="nav-link" href="QnA.php">QnA</a></li>
          </ul>
          <ul class="navbar-nav navbar-right ml-auto mt-2 mt-lg-0">
            <li class="nav-item"><a class="nav-link" href="teacherLogin/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <?php
          if(isset($_GET['subject']))
          {
            $subjectID=$_GET['ID'];
    //echo $subjectID;
          }

          if(isset($_GET['subject'])&&isset($_GET['module']))
          {
            $mID = $_GET['module'];
            $getContentQuery = "SELECT * FROM content WHERE Module_ID = ".$mID;
            $getContent = $pdo->query($getContentQuery);
            while($row = $getContent->fetch(PDO::FETCH_ASSOC))
            {
              echo "<br>";
              echo "<p>".$row['Content_Description']."</p>";
              //echo "<br>";
              echo ('<iframe class="mt-4" src="notes/'.$row['Content_Location'].'" style="width: 1000px; height: 800px;" frameborder="0">');
              echo ('</iframe>');
            }
            $next_mID=$mID+1;
            $prev_mID=$mID-1;
            if($_GET['module']!=1)
            {
              echo ("<a href='displayNotes.php?subject=".$subjectName."&ID=".$thisSubjectID."&module=".$prev_mID."'><button type='button' class='btn btn-outline-light'> Prev </button></a>");
            }
            if($_GET['module']!=6)
            {
              echo ("<a href='displayNotes.php?subject=".$subjectName."&ID=".$thisSubjectID."&module=".$next_mID."'><button type='button' class='btn btn-outline-light'> Next </button></a>");
            }
          }
        ?>
      </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/selector.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>