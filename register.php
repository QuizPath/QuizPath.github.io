<html>
<head>
	<link rel = "stylesheet" type="text/css" href="register.css">
	<title>QuizPath</title>
</head>
<body>	
<?php

const DB_HOST = "csmath-cuda";
const DB_USER = "quizpath";
const DB_PASS = "quizpath";
const DB_NAME = "quizpath";

?>	

	<br>

	<img class="logo" src="logo.png" alt="logo not loaded" style="width:300px;height:74px"> 

	<br>

	<div class = "lineUnderLogo"><hr /></div>

	<br>

	<a class="message" id ="message"> Create a new QuizPath account! </a>

	<br>
	
	<!-- The HTML registration form -->
	<form class="form" action="<?=$_SERVER['PHP_SELF']?>" method="post"> <br>
		Username:   <input type="text" name="username" /><br><br>
		Password:   <input type="password" name="password" /><br><br>
		Confirm Password: <input type="password" name = "confirm" /><br><br>
		First name: <input type="text" name="first_name" /><br><br>
		Last name:  <input type="text" name="last_name" /><br><br>
		Email:      <input type="type" name="email" /><br><br>
		<input type="submit" name="submit" value="Create Account" /><br><br>
		<a class="backButton" href="index.html">Back to Login</a><br><br>
	</form>
	
	
<?php
if (isset($_POST['submit'])) {
		
	function changeMessage($str) {
		echo "<script type='text/javascript'>
			document.getElementById('message').innerHTML = '$str';
		;</script>";
	}
		
	function sendToSQL() {
		## connect mysql server
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		# check connection
		if ($mysqli->connect_errno) {
			echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
			exit();
		}
		## query database
		# prepare data for insertion
		$username	= $_POST['username'];
		$password	= $_POST['password'];
		$first_name	= $_POST['first_name'];
		$last_name	= $_POST['last_name'];
		$email		= $_POST['email'];

		# check if username and email exist else insert
		$exists = 0;
		$result = $mysqli->query("SELECT username from user WHERE username = '{$username}' LIMIT 1");
		if ($result->num_rows == 1) {
			$exists = 1;
			$result = $mysqli->query("SELECT email from user WHERE email = '{$email}' LIMIT 1");
			if ($result->num_rows == 1) $exists = 2;	
		} else {
			$result = $mysqli->query("SELECT email from user WHERE email = '{$email}' LIMIT 1");
			if ($result->num_rows == 1) $exists = 3;
		}

		if ($exists == 1) changeMessage("Username already exists! Try another please.");
		else if ($exists == 2) changeMessage("Username and Email already in use!");
		else if ($exists == 3) changeMessage("Email already in use! Use another Address please.");
		else {
			# insert data into mysql database
			$sql = "INSERT  INTO `user`
					VALUES (NULL, '{$username}', '{$password}', '{$email}', '{$first_name}', '{$last_name}')";

			if ($mysqli->query($sql)) {
				//echo "New Record has id ".$mysqli->insert_id;
				echo "<p>Registred successfully!</p>";
			} else {
				echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
				exit();
			}
		}
	}///END sendToSQL()
	
	function validateInfo () {
	
		$shouldSendToSQL = true;
		$message = "";
		
		
		//Check if username field is empty
		if ( strlen($_POST['username'])==0 ) {
			$message .= "Please enter a Username.\\n\\n";
			$shouldSendToSQL = false;
		}
		
		//check if password is empty
		if (strlen($_POST['password'])==0 ) {
			$message .= "Please enter a Password.\\n\\n";
			$shouldSendToSQL = false;
		}
		
		//check if First Name is empty
		if (strlen($_POST['first_name'])==0 ) {
			$message .= "Please enter your First Name.\\n\\n";
			$shouldSendToSQL = false;
		}		
		
		//check if Last Name is empty
		if (strlen($_POST['last_name'])==0 ) {
			$message .= "Please enter your Last Name.\\n\\n";
			$shouldSendToSQL = false;
		}	

		//check if Email is empty
		if (strlen($_POST['email'])==0 ) {
			$message .= "Please enter an email address.\\n\\n";
			$shouldSendToSQL = false;
		}			
		
		//Check is username has spaces
		for ($i=0; $i<strlen($_POST['username']); $i++) {
			if ( $_POST['username'][i] == " " ) {
				$message .= "Usernames must not contain spaces.\\n\\n";
				$shouldSendToSQL = false;
			}
		}
		
		//Check if email has @
		$hasSign = false;
		for ($i=0; $i<strlen($_POST['email']); $i++) {
			if ( $_POST['username'][i] == "@" ) {
				$message .= "Please Use a Valid Email Adress.\\n\\n";
				$shouldSendToSQL = false;
			}
		}
		
		//Check to see if password is at least five chars
		if ( strlen($_POST['password']) < 5 ) {
			$message .= "Your password must be at least five characters.\\n\\n";
			$shouldSendToSQL = false;
		}
		
		//Check to see if passwords Match
		if ( $_POST['password'] != $_POST['confirm'] ) {
			$message .= "Your Passwords do not match.\\n";
			$shouldSendToSQL = false;
		}
		
		if ($shouldSendToSQL) 
			sendToSQL();
		else
			echo "<script type='text/javascript'>alert('$message')</script>";
		}
		
		//Call scripts
		validateInfo();
	}
	
?>		

</body>
</html>