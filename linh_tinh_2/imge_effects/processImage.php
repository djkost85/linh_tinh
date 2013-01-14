<?php
	session_start();
	$act = $_POST['act'];
	$image = $_POST['img'];
	$_SESSION['imgArray'][] = $image;

	$picture = "original/".$image;
	$img_type = exif_imagetype($picture);
	if($img_type == "2")	
		$c_image = imagecreatefromjpeg($picture);
	elseif($img_type == "1")
		$c_image = imagecreatefromgif($picture);
	elseif($img_type == "3")
		$c_image = imagecreatefrompng($picture);

	if($act != "undo" && $act != "redo" && $act != "rot")
	{
		$effects = array(
					"neg" => IMG_FILTER_NEGATE,
					"blr" => IMG_FILTER_GAUSSIAN_BLUR,
					"brg" => IMG_FILTER_BRIGHTNESS,
					"clr" => IMG_FILTER_COLORIZE,
					"cntr" => IMG_FILTER_CONTRAST,
					"edgd" => IMG_FILTER_EDGEDETECT,
					"gray" => IMG_FILTER_GRAYSCALE,
					"mean" => IMG_FILTER_MEAN_REMOVAL,
					"seleb" => IMG_FILTER_SELECTIVE_BLUR,
					"smth" => IMG_FILTER_SMOOTH,
		);
		
		if(file_exists($picture))
		{
			if($act == "brg")
				imagefilter($c_image, $effects[$act],-50);
			elseif($act == "clr")
				imagefilter($c_image, $effects[$act],0, -155, -255);
			elseif($act == "cntr")
				imagefilter($c_image, $effects[$act],60);
			elseif($act == "smth")
				imagefilter($c_image, $effects[$act],20);
			else
				imagefilter($c_image, $effects[$act]);
			savePicture($c_image,$act."_".$image,$img_type);
			//unlink("../active/".$picture);
		}
		else
		{
			echo "Image not found...!";
		}
	}
	elseif($act == "undo")
	{
		//If prev index = 0 then hide undo button
		//print_r($_SESSION['imgArray']);
		$prev = array_search($image,$_SESSION['imgArray']) - 1;
		if($prev > 0)
			echo $_SESSION['imgArray'][$prev];
		else
			echo $_SESSION['imgArray'][0];
	}
	elseif($act == "redo")
	{
		$next = array_search($image,$_SESSION['imgArray']) + 1;
		if($next < count($_SESSION['imgArray']))
			echo $_SESSION['imgArray'][$next];
		else
			echo $_SESSION['imgArray'][0];
	}
	elseif($act == "rot")
	{
		$angle = $_POST['angle'];
		$ss = imagerotate($c_image,$angle,$black);
		savePicture($ss,$act."_".$image,$img_type);
	}
    function savePicture(&$image, $file,$img_type)
    {
        //write image to a file
		if($img_type == "2")
			imagejpeg($image, "original/".$file);
		elseif($img_type == "1")
			imagegif($image, "original/".$file);
		elseif($img_type == "3")
			imagepng($image, "original/".$file);

        //clean up memory
        imagedestroy($image);
        //print image tag
        echo $file;
    }	
?>