<?php
ini_set('display_errors', 0);
ini_set('error_reporting', E_NONE);
$mt = microtime();
$mt = str_replace("0.", "", $mt);
$mt = str_replace("-", "", $mt);
$mt = str_replace(" ", "", $mt);
foreach (glob("temp/*.gif") as $filename)
{
		@unlink($filename);
}
if (stripslashes($text == ""))
{
		(stripslashes($text = "this one's for you"));
} // button text
if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) !== '')
{
		$button = ($_REQUEST['smiley']);
}
else
{
		$button = 'grey';
}
$im_info = getimagesize("s/$button.gif"); // button size
$buttonwidth = "$im_info[0]";
$buttonheigth = "$im_info[1]";
if (isset($width) || isset($heigth))
{ // size change expected?
		$ima = imagecreatefromgif("s/$button.gif"); // open input gif
		$im = imagecreatetruecolor($buttonwidth, $buttonheigth); // create img in desired size
		$uglybg = ImageColorAllocate($im, 0xf4, 0xb2, 0xe5);
		ImageRectangle($im, 0, 0, $buttonwidth, $buttonheigth, $uglybg);
		$dummy = imagecopyresized($im, $ima, 0, 0, 0, 0, $buttonwidth, $buttonheigth, $im_info[0], $im_info[1]);
		if ($dummy == "")
		{
				ImageDestroy($im); // if it didn't work, create default below instead
		}
		else
		{
				;
		}
		ImageDestroy($ima);
		ImageColorTransparent($im, $uglybg);
}
else
{
		$im = imagecreatefromgif("s/$button.gif"); // open input gif
}
if ($im == "")
{
		$im = imagecreate($buttonwidth, $buttonheigth); // if input gif not found,
		$rblue = ImageColorAllocate($im, 200, 222, 200); // create a default box
		ImageRectangle($im, 0, 0, 200, 100, $rblue);
}
if ($id !== 'copyright')
{
		$text = "[iAG] Decoded";
}
$path = getCWD();
$x = 0;
$y = 3;
$width = 184;
if (isset($_REQUEST['font']) && ($_REQUEST['font']) !== '')
{
		$font = "" . $path . "/" . $_REQUEST['font'] . "";
}
else
{
		$font = "$path/font/arialbd.ttf";
}
$textSize = 10;
if (isset($_REQUEST['fup']) && ($_REQUEST['fup']) !== '')
{
		$fup = ($_REQUEST['fup']);
		$textSize = $textSize + $fup;
}
$tx = imagecreate(184, 34);
$trans = ImageColorAllocate($tx, 200, 222, 200);
imagecolortransparent($tx, $trans);
if (isset($_REQUEST['color']) && ($_REQUEST['color']) !== '')
{
		$color = ($_REQUEST['color']);
}
else
{
		$color = '0000FF';
}
$color = hexColorAlloc($tx, $color);
imageTextWrapped($tx, $x, $y, $width, $font, $color, $text, $textSize, $align = "c");
imagecopymerge($im, $tx, 186 / 2 - 184 / 2, 5, 0, 0, 184, 34, 100);
ImageGIF($im, "temp/$mt.gif", 100); // send button to browser
ImageDestroy($im); // free the used memory
echo "<img src='temp/$mt.gif' alt='Smiley Signmaker ©'>";
function hexColorAlloc($im, $hex)
{
		$a = hexdec(substr($hex, 0, 2));
		$b = hexdec(substr($hex, 2, 2));
		$c = hexdec(substr($hex, 4, 2));
		return ImageColorAllocate($im, $a, $b, $c);
}
//A function for pixel precise text Wrapping
function imageTextWrapped(&$img, $x, $y, $width, $font, $color, $text, $textSize, $align = "l")
{
		//Recalculate X and Y to have the proper top/left coordinates instead of TTF base-point
		$y += $textSize;
		$dimensions = imagettfbbox($textSize, 0, $font, " "); //use a custom string to get a fixed height.
		$x -= $dimensions[4] - $dimensions[0];
		$text = str_replace("\r", '', $text); //Remove windows line-breaks
		$srcLines = split("\n", $text); //Split text into "lines"
		$dstLines = array(); // The destination lines array.
		foreach ($srcLines as $currentL)
		{
				$line = '';
				$words = split(" ", $currentL); //Split line into words.
				foreach ($words as $word)
				{
						$dimensions = imagettfbbox($textSize, 0, $font, $line . $word);
						$lineWidth = $dimensions[4] - $dimensions[0]; // get the length of this line, if the word is to be included
						if ($lineWidth > $width && !empty($line))
						{ // check if it is too big if the word was added, if so, then move on.
								$dstLines[] = ' ' . trim($line); //Add the line like it was without spaces.
								$line = '';
						}
						$line .= $word . ' ';
				}
				$dstLines[] = ' ' . trim($line); //Add the line when the line ends.
		}
		//Calculate lineheight by common characters.
		$dimensions = imagettfbbox($textSize, 0, $font, "MXQJPmxqjp123"); //use a custom string to get a fixed height.
		$lineHeight = $dimensions[1] - $dimensions[5]; // get the heightof this line
		$align = strtolower(substr($align, 0, 1)); //Takes the first letter and converts to lower string. Support for Left, left and l etc.
		if (count($dstLines) > 2)
		{
				echo "<strong>Sorry,<br /> Your text exceeds the size of this sign.<br /> Please shorten your message or try a smaller font size and try again!</strong><br />";
		}
		else
		{
				foreach ($dstLines as $nr => $line)
				{
						if ($align != "l")
						{
								$dimensions = imagettfbbox($textSize, 0, $font, $line);
								$lineWidth = $dimensions[4] - $dimensions[0]; // get the length of this line
								if ($align == "r")
								{ //If the align is Right
										$locX = $x + $width - $lineWidth;
								}
								else
								{ //If the align is Center
										$locX = $x + ($width / 2) - ($lineWidth / 2);
								}
						}
						else
						{ //if the align is Left
								$locX = $x;
						}
						$locY = $y + ($nr * $lineHeight);
						//Print the line.
						if (count($dstLines) < 2)
						{
								$locY = $locY + 8;
						}
						imagettftext($img, $textSize, 0, $locX, $locY, $color, $font, $line);
				}
		}
}
?>