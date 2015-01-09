<?php
	define('DB_HOST', 'csmath-cuda');
	define('DB_NAME', 'quizpath');
	define('DB_USER','quizpath');
	define('DB_PASSWORD','quizpath');

	$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " .mysql_error()); 
	
	$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error()); 
	
	

function SignIn() { 
	session_start(); //starting the session for user profile page 
	
	if(empty($_SESSION['username'])) {
		echo 'Incorrect passsword/username. Please try again.' ;
	}
	
	if(!empty($_POST['user']))  
	{ 
		$query = mysql_query("SELECT * FROM user where username = '$_POST[user]' AND pass = '$_POST[pass]'") or die(mysql_error()); 
		
		$row = mysql_fetch_array($query);
			
		if(!empty($row['username']) AND !empty($row['pass'])) 
		{ 
			$_SESSION['username'] = $row['username'];
			header( 'Location: home.php' ) ; 		
		}
		
		else {
			header('Location: index.html');
						}
	}
	
	else {
		echo "This site has encountered an error. Please contact the allamontagn@ursinus.edu"; 
	}
}
if(isset($_POST['submit']))
{
	SignIn();
}

?>

	
	