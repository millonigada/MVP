<?php 
  require_once "connections.php";

  $subjectID=1;

  if(isset($_GET['subject']))
  {
    $subjectID=$_GET['ID'];
    echo $subjectID;
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
  <link href="css/MVP1.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/rstyle.css">

</head>

<body>

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
            <li class="nav-item"><a class="nav-link" href="login.php"><span class="glyphicon glyphicon-log-in"></span> Faculty Login</a></li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <h1 class="mt-4">Notes</h1>
        <div class="container">
        <div class="row main-row">
            <?php 

              $getModuleQuery = "SELECT * FROM module WHERE Subject_ID = ".$subjectID;
              $getModule = $pdo->query($getModuleQuery);
              while($row = $getModule->fetch(PDO::FETCH_ASSOC))
              {
                    $moduleImg = 'img/module'.$row['Module_ID'].'.jpg';

                    echo ("<div class='col-md-4 mb-5'>");
                      echo("<div class='card p-3' style='width: 18rem'>");
                        echo('<img src="'.$moduleImg.'" '); 

                        echo( "alt='stock photo' class='card-img-top shadow bg-white rounded'>");
                        echo("<div class='card-body'>");
                          echo("<h5 class='card-title'>"); 
                            echo $row['Module_Name']; 
                          echo ("</h5>");
                          //   echo("<p class='card-text'>");
                          //   echo($row['Content_Type_Description']); 
                          // echo("</p>");
                          echo("
                            <button type='button' class='btn btn-outline-dark'><a href='#'> View More </a></button>
                          </div>
                        </div>
                      </div>");
              }
            ?>
        </div>
    </div>
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