<pre>

<?php
class Crawler { 

protected $markup = ''; 

public function __construct($uri) { 
     $this->markup = $this->getMarkup($uri); 
} 

public function getMarkup($uri) { 
    return file_get_contents($uri); 
} 


public function get_images() { 
    if (!empty($this->markup)){ 
        preg_match_all('/<img.+src=\"([^\"]+)\"[^\/>]+[\/]?>/i', $this->markup, $images); 
        return !empty($images[1]) ? $images[1] : FALSE; 
    } 
} 

public function get_links() { 
        if (!empty($this->markup)){ 
            preg_match_all('/<a.+href=\"([^\"]+)\"[^>]+>[^<]+<\/a>/i', $this->markup, $links); 
            return !empty($links[1]) ? $links[1] : FALSE; 
        } 
    } 
} 


$crawl = new Crawler('http://192.168.1.55/linkapp/elgg/'); 
$images = $crawl->get_images(); 
$links = $crawl->get_links(); 
//var_dump($images);
//var_dump($links);
print_r($links);
print_r($images);
?>
</pre>