<html>
	
	<head>
	<title>QuizPath</title>
	<link rel = "stylesheet" type="text/css" href="tags.css">
	</head>	
	
	<body>
	<br>
	<img class="logo" src="logo.png" alt="logo not loaded" style="width:300px;height:74px">
	<br>
	<div class = "line"><hr /></div>

	<br>
	<a class="message">Please pick a topic to be Quizzed on</a>
	
	<h3> Computer Science (Java)</h3>
	<p><a href= "dataQuiz.php">Data Types</a></p>
	<p><a href= "loopQuiz.php"> Loops </a></p>
	<p> Arrays </p>
	<p><a href= "LogicPuzzle.php">LogicPuzzle</a></p>
	
	
	<?php /*
		require_once 'login.php';
		require_once 'mysqliconnect.php';
		session_start();
		
		$username = $_SESSION['username']; 
		
		echo $username; 
		
		$query = "select id from user where user.username = $username";
		
		$row = mysql_fetch_array($query) or die(mysql_error()); 
		
		if (!empty($row['id'])){
			echo $row['id'];
			$userID = $row['id'];
		}
		
		else{
			echo "broken";
		}
		
		$insertQuery = 'insert into quiz (takenBy) values ($userID)'; 
		
		*/
	?>
	
	<br><br><hr class= line>
	<br><a class='backbutton' href='../home.php'>Return to Homepage</a>
	
	</body>
</html>