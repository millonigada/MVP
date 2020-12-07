<?php
require_once "../connections.php";
session_start();

if ( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['empID']) && isset($_POST['mobileNo']) && isset($_POST['password'])) {

    // Data validation
    if ( strlen($_POST['name']) < 1 || strlen($_POST['password']) < 1) {
        $_SESSION['error'] = 'Missing data';
        echo $_SESSION['error'];
        header("Location: register.php");
        return;
    }

    if ( strpos($_POST['email'],'@') === false ) {
        $_SESSION['error'] = 'Bad data';
        echo $_SESSION['error'];
        header("Location: register.php");
        return;
    }

    // if (isset($_POST['dataStructures'])) {
    // 	$dataStructures = 
    // }

    $insertIntoTeacherRegisterQuery = "INSERT INTO teacher_register (Emp_ID, Name, Designation, Email_ID, Mobile_No) VALUES (:empID, :name, :designation, :email, :mobileNo)";
    $insertIntoTeacherRegister = $pdo->prepare($insertIntoTeacherRegisterQuery);
    $insertIntoTeacherRegister->execute(array(
        ':empID' => $_POST['empID'],
        ':name' => $_POST['name'],
        ':designation' => $_POST['designation'],
        ':email' => $_POST['email'],
        ':mobileNo' => $_POST['mobileNo']));

    $getTeachIDQuery = "SELECT Teach_ID FROM teacher_register WHERE Email_ID = :email";
    $getTeachID = $pdo->prepare($getTeachIDQuery);
    $getTeachID->execute(array(':email' => $_POST['email']));
    $teachID = $getTeachID->fetch(PDO::FETCH_ASSOC);

    $insertIntoTeacherLoginQuery = "INSERT INTO teacher_login (Teach_ID, Email_ID, Password) VALUES (:teachID, :email, :password)";
    $insertIntoTeacherLogin = $pdo->prepare($insertIntoTeacherLoginQuery);
    $insertIntoTeacherLogin->execute(array(
        ':teachID' => $teachID,
        ':email' => $_POST['email'],
        ':password' => $_POST['passWord']));

    $_SESSION['success'] = 'Record Added';
    header( 'Location: login.php' );
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Register Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="img/MVP.png" alt="bootstrap 4 login page">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Register</h4>
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="name">Name</label>
									<input id="name" type="text" class="form-control" name="name" required autofocus>
									<div class="invalid-feedback">
										Name cannot be blank
									</div>
								</div>

								<div class="form-group">
									<label for="empID">Employee ID</label>
									<input id="empID" type="text" class="form-control" name="empID" required>
									<div class="invalid-feedback">
										Please enter appropriate employee ID
									</div>
								</div>

								<div class="form-group">
									<label for="designation">Designation</label>
									<input id="designation" type="text" class="form-control" name="designation">
								</div>

								<div class="form-group">
									<label for="mobileNo">Mobile Number</label>
									<input id="mobileNo" type="text" class="form-control" name="mobileNo" required>
									<div class="invalid-feedback">
										Please enter appropriate Mobile Number
									</div>
								</div>

								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" required>
									<div class="invalid-feedback">
										Your email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="passWord" required data-eye>
									<div class="invalid-feedback">
										Password is required
									</div>
								</div>

								<div class="form-group">
									Select Your Subjects
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input id="dataStructures" type="checkbox" class="custom-control-input" name="dataStructures" required="">
										<label for="dataStructures" class="custom-control-label">Data Structures</label>
									</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input id="computerGraphics" type="checkbox" class="custom-control-input" name="computerGraphics" required="">
										<label for="computerGraphics" class="custom-control-label">Computer Graphics</label>
									</div>
								</div>

								<!-- <div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="agree" id="agree" class="custom-control-input" required="">
										<label for="agree" class="custom-control-label">I agree to the <a href="#">Terms and Conditions</a></label>
										<div class="invalid-feedback">
											You must agree with our Terms and Conditions
										</div>
									</div>
								</div> -->

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Register
									</button>
								</div>
								<div class="mt-4 text-center">
									Already have an account? <a href="login.php">Login</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2020 &mdash; MVP 
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>
</html>