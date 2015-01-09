<?php

	function getRandQuestions($tag, $link)
	{
		$query = "select distinct appliesTo.question from appliesTo join tag on appliesTo.tag = $tag order by RAND() limit 10;"; 
		$result = mysqli_query($link, $query); 
		
		$rows = mysqli_num_rows($result);
		$answers = array();
		
		for ($i = 0; $i < $rows; ++$i) 
		{
			$row = mysqli_fetch_array($result, MYSQLI_NUM); 
			
			$text = $row[0]; 
			$answers[] = $text;
		}
		return $answers;
	}

	function getQuestionText($qID, $link) 
	{
		$query = "select questionText from questions where questions.id = $qID"; 
		$result = mysqli_query($link, $query); 
		
		$rows = mysqli_num_rows($result);
		$answers = array();
		
		for ($i = 0; $i < $rows; ++$i) 
		{
			$row = mysqli_fetch_array($result, MYSQLI_NUM); 
			
			$text = "<p>$row[0]</p> <br> \n"; 
			$answers[] = $text;
		}
		return $answers;
		
	}

	
	function getAnswers($qID, $link)
	{
		$query = "select ansText from answer where answer.questionID = $qID";
		//echo $query; 
		$result = mysqli_query($link, $query); 
		
		$rows = mysqli_num_rows($result);
		$answers = array();
		
		//This displays the radio buttons with the answers for one question. 
		for ($i = 0; $i < $rows; ++$i) 
		{
			$row = mysqli_fetch_array($result, MYSQLI_NUM); 
			
			$text = "$row[0]"; 
			$answers[] = $text;
		}
				
		return $answers;
	}
?>