<html>
	
	<head>
	<title>QuizPath</title>
	<link rel = "stylesheet" type="text/css" href="results.css">
	</head>
	
	<body>
	
	<br>
	<img class="logo" src="logo.png" alt="logo not loaded" style="width:300px;height:74px"> 
	<br>

	<div class = "lineUnderLogo"><hr /></div>
	
	<br><br>
	
	<?php
		require_once 'login.php';
		require_once 'mysqliconnect.php';

		$c = 0;
		foreach($_POST as $key => $value)
		{
			$query = "SELECT answer.isCorrectAnswer from answer where questionID = $key AND answer.ansText = '$value';";
			$result = mysqli_query($link, $query); 
			$row = mysqli_fetch_array($result, MYSQLI_NUM); 
			$c = $c+$row[0];
		}
	
		echo "<a class='message'>You scored: $c / 10 !</a><br>";
		if ( $c < "5")
			{ echo "<a class='message2'>Better luck next time! </a>"; }
		elseif ($c > "8")
			{ echo "<a class='message2'> Great work!</a>"; }
			
		//Print out Buttons to html
		echo "	<br><a class='retryButton' href='tags.php'>Take a similar Quiz!</a><br>
				<a class='backButton' href='../home.php'>Back to Home</a>";
			

	?>
	

	
	</body>

</html>