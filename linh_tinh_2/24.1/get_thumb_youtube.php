<?php
        function getYoutubeImage($e){
        //GET THE URL
        $url = $e;

        $queryString = parse_url($url, PHP_URL_QUERY);

        parse_str($queryString, $params);

        $v = $params['v'];  
        //DISPLAY THE IMAGE
        if(strlen($v)>0){
            echo "<img src='http://img.youtube.com/vi/$v/0.jpg' width='150' />";
            echo "<img src='http://img.youtube.com/vi/$v/1.jpg' width='150' />";
            echo "<img src='http://img.youtube.com/vi/$v/2.jpg' width='150' />";
            echo "<img src='http://img.youtube.com/vi/$v/3.jpg' width='150' />";
        }
    }
?>

<?php
    getYoutubeImage("http://www.youtube.com/watch?v=izbf47H_wpY&feature=youtu.be");
?>
