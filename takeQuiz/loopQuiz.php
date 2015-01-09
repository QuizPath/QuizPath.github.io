<!DOCTYPE html>
<html>
	<head>
		<title>Quizpath</title>
		<link rel = "stylesheet" type="text/css" href="quiz.css">
	</head>
	
	<body>
	<?php
		require_once 'login.php';
		require_once 'mysqliconnect.php';
		require_once 'getQueries.php';
	?>
	
	<br>
	<img class="logo" src="logo.png" alt="logo not loaded" style="width:300px;height:74px"> 
	<br>
	<div class = "lineUnderLogo"><hr /></div>
	<br>

	
	<p class="directionsMessage"> Directions: Read the question and following answers carefully. Then select your answer and press the button once you have answered all questions.<br> </p> 
	<div class = "secondLine"><hr></div>
	<br> 
	
	<form class="form" id="form" action="http://csmath-cuda/~quizpath/takeQuiz/results.php" method="post">
		<?php 
			
			$num = array();
			
			//Gets ids of randomly generated questions
			$randQuest = getRandQuestions(4, $link); 
			foreach($randQuest as $c)
			{
				$num[] = $c;
			}
			
			
			//$counter = 0; 
			foreach($num as $d)
			{			
				//Grabs question text
				$questionAr = getQuestionText($d, $link); 
				
				foreach($questionAr as $b)
				{
					echo $b;
				}
				
				//echo '<br>';
				
				//grabs answers
				$answersArray = getAnswers($d,$link);
				
				//Make another array with the answers rearranged
				$reorderedAnswers = array();
				$answerSetSize = count($answersArray);
				$answerIsInNewArray = array();
				
				for ($j=1; $j<=$answerSetSize; $j++) {
					$answerIsInNewArray[j] = false;
				}
				
				for ($j=1; $j<=$answerSetSize; $j++) {
					
					$random = rand(1,$answerSetSize);
					
					while ( $answerIsInNewArray[$random] )
							$random = rand(1,$answerSetSize);
					
					$reorderedAnswers[$j-1] = $answersArray[$random-1];
					$answerIsInNewArray[$random] = true;
				}
				 
				//Put rearranged answers and buttons on the document
				foreach($reorderedAnswers as $a) 
				{
					echo "<input type='radio' name='$d' value='$a' required> $a <br>";
				}
				
				echo "<br> <hr class='lineType3'>";
				
			}
		?>
	<br>
	
	<!-- This button allows the user to move on to the next screen.--> 
            <input class="submitButton" type="submit" name="moveButton" value="Finished"> 
	</form>
	
	<br><br>

	</body>
	
</html>