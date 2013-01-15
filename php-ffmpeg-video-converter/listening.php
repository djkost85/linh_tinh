<?php
session_start();

$time=$_SESSION['name'];
$file=$_SESSION['dest_file'].".".$_SESSION['type'];


//echo "vrijeme je: ".$time."<br> fajl je: ".$file."<br>";

if ( file_exists ($file) ) { echo "";} else { 

echo "<img src=\"icons/circle-alert.png\" border=\"0\" /><br>";
echo "Something went wrong, there is no converted video in dest_file folder! <br> Look at the log/ files!";
echo "<a href=\"step_1.php\">"."<img src=\"icons/arrow-left.png\" border=\"0\" /></a>";


 exit;}

if ( file_exists ( "log/" . $time. '.txt' ) ) 

{

// read log file ad search for words
// "muxing" overhed mean that video is succefuly finished
// "missing" is usualiy for missing codec

$logtext = file_get_contents("log/".$time.".txt", true);
$findme   =array ('missing', 'failed', 'incorrect');
$finished = array ('muxing');
foreach($findme  as $value) 
	{

	  $pos = strpos($logtext, $value);
	  if ($pos === false) 
	  {
		$found=0;
		
		} 
	  else 
	  { 
	  	$found=1;
	  
	  }
	}
	
	
	foreach($finished  as $value2) 
	{

		  $pos = strpos($logtext, $value2);
		  if ($pos == true) 
		  {
			$status="finished";
			echo "<img src=\"icons/circle-check.png\" /><br>";
			echo "status: <b><br>FINISHED!</b><br>";
			
					// read a video duration from a video
					require_once"get_video_duration.php";
					
					//Display a video duration 
					
					echo "<br> Video duration: ".$hours.":".$minutes.":".$seconds;
					$_SESSION['duration']=$hours.":".$minutes.":".$seconds;
					$_SESSION['time_in_seconds']=$time_in_seconds;
								
					echo "<br><a href=\"step_3.php\" border=\"0\"><br><img src=\"icons/arrow-right.png\" border=\"0\" /></a>";
					flush();
					exit;
		
		  }
			
		
	 }
	if($found==0)
		{	
		echo "<img src=\"icons/gears.png\" border=\"0\" /><br>";
			echo "<img src=\"loading.gif\" />";
		echo "<br> <b>CONVERTING VIDEO!</b> <br><u>DO NOT CLOSE THIS WINDOW!</u><br> This might take long, please wait...<br>"; 
		$temp_size_fajla = filesize($file);
		$size_u_mb = round(($temp_size_fajla/1048576),2);
		echo "Your new video size: ".$size_u_mb." MB";
					
				
		}
	elseif($found==1) 
	{	echo "<img src=\"icons/circle-alert.png\" border=\"0\" /><br>";
		echo "<br><br>oopps something went wrong, please check log file / probably the codec is missing!<br><u>CONVERTING FAILED!</u><br><br>Please try a different video!<br><br>status: converting stoped!";
		echo "<br><a href=\"step_1.php\">"."<img src=\"icons/arrow-left.png\" border=\"0\" /></a>";
		exit; session_unset();
	}
	


  
?>

<?php
exit;
} 



?>