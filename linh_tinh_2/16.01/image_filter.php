<?php
  header('Content-type: image/jpeg');
  $jpg_image = imagecreatefromjpeg('Liu-fi.jpg');
  $filter = $_GET['filter'];
    error_log("----------------$filter-------------");
  switch($filter){
  	case 1:
  imagefilter($jpg_image, IMG_FILTER_NEGATE);
  	break;
  case 2:
  imagefilter($jpg_image, IMG_FILTER_BRIGHTNESS);
  	break;
  case 3:
   imagefilter($jpg_image, IMG_FILTER_CONTRAST);
  	break;
  case 4:
   imagefilter($jpg_image, IMG_FILTER_COLORIZE);
  	break;
  case 5:
   imagefilter($jpg_image, IMG_FILTER_EDGEDETECT);
  	break;
  case 6:
   imagefilter($jpg_image, IMG_FILTER_EMBOSS);
  	break;
  case 7:
   imagefilter($jpg_image, IMG_FILTER_GAUSSIAN_BLUR);
  	break;
  case 8:
  imagefilter($jpg_image, IMG_FILTER_SELECTIVE_BLUR);
  	break;
  case 9:
 imagefilter($jpg_image, IMG_FILTER_MEAN_REMOVAL);
  	break;
  case 10:
  imagefilter($jpg_image, IMG_FILTER_SMOOTH);
  	break;
  case 11:
 imagefilter($jpg_image, IMG_FILTER_PIXELATE);
  	break;
  default:
	  imagefilter($jpg_image, IMG_FILTER_GRAYSCALE);
  	break;
	  
  }
  imagejpeg($jpg_image);
  imagedestroy($jpg_image);
?> 

