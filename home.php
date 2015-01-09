<?php
	include ('session.php');
?>
<!DOCTYPE HTML>
<html>

<head>
<title>QuizPath</title>
<link rel = "stylesheet" type="text/css" href="home.css">
</head>

<body onload=init();>

<br>

<img class="logo" src="logo.png" alt="logo not loaded" style="width:300px;height:74px"> 

<br>

<div class = "lineUnderLogo"><hr /></div>

<a class = "quizLink" href="takeQuiz\tags.php">Take a Quiz!</a>

<a class = "historyLink" href="userInfo.html">My Quiz History</a>

<a class = "loggedinName">
	<?php
		session_start();
		echo "Welcome, " . $_SESSION['username'] . "!"; 
	?>
 </a>

<a class = "logoutLink" href="logout.php">Logout</a>

<div class = "lineUnderButtons"><hr /></div>

<h2 class = "date">Today is:</h3>

<span id='demo' ></span>

<a class = "graph1"> Quiz Progress </a>

<a class = "linksHeader" id = "linksHeader"><a>
<br>
<a class = "link0" id="link0">Link0</a>
<br>
<a class = "link0" id="link1">Link1</a>

<img class="graphBar" src="graphImages\bar.png" alt="img" style="width:525px;height:16px">
<img class="graphRuler" src="graphImages\ruler.png" alt="img" style="width:37px;height:138px">
<a class="graphParts" id="graphParts"></a>

<!------------------JavaScript------------------->
<script type="text/javascript"> 

function init() {

	makeExternalLinks();
	
	makeGraph();

	step();
}

function step(){
	document.getElementById('demo').innerHTML = Date();
	setTimeout('step()',1000)
}

function makeExternalLinks() {
	
	var userStudiesGerman = true;
	var userStudiesJava = true;
	var currentExternalLink  = 0;
	
	document.getElementById("linksHeader").innerHTML= "Try These External Resources:";
	
	//German Dictionary Link
	if (userStudiesGerman) {
		var link;
		switch(currentExternalLink)
		{
			case 0:
				link = document.getElementById("link0");
				break
			case 1:
				link = document.getElementById("link1");
				break;
		}
		link.innerHTML = "Struggling with your vocabulary? Try this online German dictionary";
		link.href = "http://dict.cc";
		currentExternalLink++;
	}
	
	//Java Help Link
	if (userStudiesJava) {
		var link;
		switch(currentExternalLink)
		{
			case 0:
				link = document.getElementById("link0");
				break
			case 1:
				link = document.getElementById("link1");
				break;
		}
		link.innerHTML = "Need a refresher on Java arrays? Try this site.";
		link.href = "http://www.learnjavaonline.org/en/Arrays";
		currentExternalLink++;
	}
}

function makeGraph() {
	
	var graphX = 70;
	var graphY = 275;
	var graphWidth = 500;
	var graphHeight = 125;
	
	var quizTopic = "Data Types";
	var quizDates = [0, 3, 5, 6, 14, 15]; //Dates here are number of days ago the test was taken
	var quizScores = [100, 70, 72, 65, 34, 20];
	
	var totalPoints = quizScores.length;
	
	//Generate HTML for each point on the graph
	var str="";
	for (var i=0; i<quizDates.length; i++) {
		str += '<img class="graphPoint' + i + '" id="graphPoint' + i +'" src="graphImages\\point.png" alt="img" style="width:16px;height:16px;position:absolute;display:block;top:-100px;">';
	}
	document.getElementById('graphParts').innerHTML = str;
	
	///Set Position of points 
	//Left:70 = leftEdge of graph   Left:570 = rightEdge of graph
	//Top:400 = bottom of graph    Top:275 = Top of graph

	//Horizantal Distance for each day 
	var distance = graphWidth/( quizDates[quizDates.length-1] - quizDates[0] );

	for (var i=0; i<totalPoints; i++) {
		var point = document.getElementById( 'graphPoint' + i );
		point.style.top = 275 - ( (quizScores[i]-100) * (graphHeight/100) ) + 'px';
		point.style.left = 570 - ( ( quizDates[i]-quizDates[0]) *distance) + 'px';
	}
}

</script>
<!-----------------End-JavaScript----------------->	

</body>

</html>

