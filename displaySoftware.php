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

</head>

<body>

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
            <h1>Languages</h1>
            <br>
            <ul style="list-style-type: none">
              <li><h3>PHP</h3></li>
              <li>It is a general purpose scripting language, especially suited to web development. It is a flexible and useful programming language, used extensively for building out web applications, websites, cloud computing and even machine learning.</li>
              <li><a href="https://www.youtube.com/watch?v=qVU3V0A05k8&list=PL0eyrZgxdwhwBToawjm9faF1ixePexft-">PHP Tutorial</a></li>
              <li><h3>Javascript</h3></li>
              <li>Often abbreviated as JS, it is a programming language that conforms to the ECMAScript specification. It is high-level, often just-in-time compiled, and multi-paradigm.</li>
              <li><a href="https://www.youtube.com/watch?v=qoSksQ4s_hg&list=PL4cUxeGkcC9i9Ae2D9Ee1RvylH38dKuET">JavaScript Tutorial</a></li>
              <li><h3>Ruby</h3></li>
              <li>Ruby is a dynamic open-source programming language with a focus on simplicity and productivity. It is most used for coding web applications.</li>
              <li><h3>Python</h3></li>
              <li>Perhaps one of the most versatile languages ever, it is used for a whole host of things ranging from web development(using the DJango Framework), to machine learning, data science etc</li>
              <li><a href="https://www.python.org/downloads/">Download Python</a></li>
            </ul>
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