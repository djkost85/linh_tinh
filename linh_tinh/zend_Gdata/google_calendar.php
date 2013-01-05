
<?php
//Zend_Gdata/library/google_calendar
// luon dat chung thu muc cha voi thu muc lib Zend
require_once 'Zend/Gdata.php';
require_once 'Zend/Loader.php';
	Zend_Loader::loadClass('Zend_Gdata');
	Zend_Loader::loadClass('Zend_Gdata_Calendar');
    Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
    Zend_Loader::loadClass('Zend_Http_Client');
function google_calendar(){
	$user = "zuongthao.tn@gmail.com";
    $pass = "";
    
    $gcal_ = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
    
    $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $gcal_);
    $gcal = new Zend_Gdata_Calendar($client);
			$query = $gcal->newEventQuery();
			$query->setUser('default');
			$query->setVisibility('private');
			$query->setProjection('full');
			$query->setOrderby('starttime');
			$query->setSortOrder('a');
			$query->setFutureevents('true');
			$query->setSingleEvents('true');
		//neu muon serch noi dung trong google calendar them vao query
		//$query->setQuery('tu khoa muon search');
 
	    	try {
			    $feed = $gcal->getCalendarEventFeed($query);
			} catch (Zend_Gdata_App_Exception $e) {
			    echo "Error: " . $e->getMessage();
			}

    foreach ($feed as $event) {
      echo "<li>\n";
      echo "<h2>" . stripslashes($event->title) . "</h2>\n";
      echo stripslashes($event->summary) . " <br/>\n";
      $id = substr($event->id, strrpos($event->id, '/')+1);      
      echo "</li>\n";
    }
    }
google_calendar();
