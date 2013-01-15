<?php

$duration = file_get_contents("log/".$time.".txt", true);
$findme   =array ('duration');

$pos = strpos($duration , $findme);
if ($pos === false) 
	  {
	  
	  	 $search='/Duration: (.*?)[.]/';
$duration=preg_match($search, $duration, $matches, PREG_OFFSET_CAPTURE);
$duration = $matches[1][0];

//i suppose that our video hasn't duration of a day+ :
//list($hours, $mins, $secs) = split('[:]', $logtext);

//echo $logtext;

list($hours, $minutes, $seconds) = explode(":", $duration);
		/*echo "<br>hours: ".$hours;
		echo "<br>minutes: ".$minutes;
		echo "<br>sec: ".$seconds;*/
		
	$time_in_seconds=$hours*3600+$minutes*60+$seconds;
	//echo "<br> ".$time_in_seconds;
	//$time_in_seconds=round($time_in_seconds/2);


		
		} 
	  else 
	  { 
	  echo "Error! Can not get video duration!";
	  
	  }

?>