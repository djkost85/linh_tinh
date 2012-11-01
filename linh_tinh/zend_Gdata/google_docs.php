<pre>
<?php
require_once 'Zend/Gdata.php';
require_once 'Zend/Loader.php';
	Zend_Loader::loadClass('Zend_Gdata');
	Zend_Loader::loadClass('Zend_Gdata_Docs');
    Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
    Zend_Loader::loadClass('Zend_Http_Client');
	Zend_Loader::loadClass('Zend_Gdata_Docs_Query');


function google_docs(){
	$user = "zuongthao.tn@gmail.com";
    $pass = "";
	try{
        $gdocs_auth = Zend_Gdata_Docs::AUTH_SERVICE_NAME;
        $google_str = "";
            $gdocs =  Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $gdocs_auth);
            $client = new Zend_Gdata_Docs($gdocs);
            //$feed = $client->getDocumentListFeed();
            //$query = "function";
			$docsQuery = new Zend_Gdata_Docs_Query();
    			$docsQuery->setQuery("function");
    			$feed = $client->getDocumentListFeed($docsQuery);
			try{
	            $count = count($feed->entries);
	            if($count > 10){
	                $n = 10;
	            }else $n = $count;
	            for($i=0; $i<$n; $i++){
	                $alternateLink = '';
	                foreach ($feed->entries[$i]->link as $link) {
	                        if ($link->getRel() === 'alternate') {
	                            $alternateLink = $link->getHref();
	                        }
	                }
	                $google_str .= "<a href='$alternateLink' style='cursor: pointer;' target='_blank'><div class='block_list'><li class='new_cut_line'>\n";
	                $google_str .= $feed->entries[$i]->title;    
	                $google_str .= "</li></div></a>\n";
	            }
	            if($count>10){
	                $google_str .= "<div class=\"more more_google_app\"><a target='_blank' href=\"http://docs.google.com\">".elgg_echo('feed:more')."</a></div>";
	            }
			}catch(Exception $e){
				echo "Error: " . $e->getMessage();
			}

           	
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        return $google_str;
        //return array('google_str'=>$google_str, 'docs_count'=>$count);
        //return $feed;
}	
	
$google_docs = google_docs();
if($google_docs){
	echo "success!!";
}
else{
	echo "false @@";
}
//print_r($google_docs);
echo $google_docs;
?>
</pre>
