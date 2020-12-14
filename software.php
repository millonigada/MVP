<?php 
  
  require_once "connections.php";

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

          $getStreamQuery = "SELECT * FROM stream";
          $getStream = $pdo->query($getStreamQuery);
          while($row = $getStream->fetch(PDO::FETCH_ASSOC))
          {
            echo ('<a href="#" class="list-group-item list-group-item-action bg-light">');
            echo ($row['Stream_Name']);
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
            <li class="nav-item"><a class="nav-link" href="notes.php">Notes</a></li>
            <li class="nav-item"><a class="nav-link" href="resources.php">Resources</a></li>
            <li class="nav-item" id="menu-toggle"><a class="nav-link" href="#">Software</a></li>
            <li class="nav-item"><a class="nav-link" href="QnA.php">QnA</a></li>
          </ul>
          <ul class="navbar-nav navbar-right ml-auto mt-2 mt-lg-0">
            <li class="nav-item"><a class="nav-link" href="teacherLogin/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <div class="container">
        <div class="row main-row">
            <?php 

              $getSoftwareTypeQuery = "SELECT * FROM software_type";
              $getSoftwareType = $pdo->query($getSoftwareTypeQuery);
              while($row = $getSoftwareType->fetch(PDO::FETCH_ASSOC))
              {
                    $softwareTypeImg = 'img/softwareType'.$row['Software_Type_ID'].'.jpg';

                    echo ("<div class='col-md-4 mb-5'>");
                      echo("<div class='card p-3' style='width: 18rem'>");
                        echo('<img src="'.$softwareTypeImg.'" '); 

                        echo( "alt='stock photo' class='card-img-top shadow bg-white rounded'>");
    
                        echo("<div class='card-body'>");
                          
                          //   echo("<p class='card-text'>");
                          //   echo($row['Content_Type_Description']); 
                          // echo("</p>");
                          echo("<h5 class='card-title'>"); 
                            echo $row['Software_Type']; 
                          echo ("</h5>");
                          echo("
                            <a href='displaySoftware.php'><button type='button' class='btn btn-outline-dark'> View More </button></a>
                          </div>
                        </div>
                      </div>");
              }
            ?>
        </div>
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

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>