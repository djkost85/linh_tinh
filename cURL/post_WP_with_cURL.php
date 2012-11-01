<?php

//neu phat hien ra loi nhu the nay:
//AtomPub services are disabled on this site. An admin user can enable them at 
//http://localhost/cms/wordpress/wp-admin/options-writing.php HTTP status code: 403 

//Thi vao duong dan nay enable cac option can thiet
//http://localhost/cms/wordpress/wp-admin/options-writing.php

class atompub
    {

    //public $parae = '';

    function __construct($one, $two, $three, $four)
        {
        $this->author=$one;
        $this->title=$two;
        $this->categories=$three;
        $this->body=$four;
        }

    function create_post() 
        {
        $xmlwriter = new XMLWriter();
        $xmlwriter->openMemory();
        $xmlwriter->startDocument("1.0", "UTF-8");
            $xmlwriter->startElement('entry');
                $xmlwriter->writeAttribute('xmlns', 'http://www.w3.org/2005/Atom');
                $xmlwriter->startElement('author');
                    $xmlwriter->writeElement('name', $this->author);
                $xmlwriter->endElement();
                $xmlwriter->writeElement('title', $this->title);
                $xmlwriter->startElement('content');
                    $xmlwriter->writeAttribute('type', 'html');
                    $xmlwriter->text($this->body);
                $xmlwriter->endElement();
                $xmlwriter->startElement('category');
                    $xmlwriter->writeAttribute('term', $this->categories);
                $xmlwriter->endElement();
            $xmlwriter->endElement();
        $xmlwriter->endDocument();

        return $xmlwriter->outputMemory();
        }

    function __destruct()
        {
        }
    }


$target = "http://localhost/cms/wordpress/wp-app.php/posts";  
// Note that the directory "posts" are used for posting (POST method)
// "service" is used to pull info via the GET method (not shown here)

$user = "admin";  // Substitue XXX with your WordPress username
$passwd = "abc123";   // Substitue XXX with your WordPress password

$author='Your Name';
$title='The title of your choice for your new entry';
$array_of_categories='Wordpress';
$body='This is the main body. All the text goes in here';

$xml_post = new atompub($author,$title,$array_of_categories,$body);
$post = $xml_post->create_post();

$headers = array("Content-Type: application/atom+xml ");
$handle = curl_init($target);
$curlopt_array = array(
CURLOPT_HTTPHEADER => $headers,
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => $post,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_USERPWD => $user.':'.$passwd,
CURLOPT_FOLLOWLOCATION => true,
CURLINFO_HEADER_OUT => true);
curl_setopt_array($handle, $curlopt_array);

$result = curl_exec($handle);
//var_dump($result);
$header_sent=curl_getinfo($handle);
//var_dump($header_sent);

if ($result === false) {
print "Got " . curl_errno($handle) . " : " . curl_error($handle) . "\n";
curl_close ($handle);
return;
}

$response_http_code = curl_getinfo ($handle, CURLINFO_HTTP_CODE);
if ($response_http_code != 201) {
print("HTTP status code: $response_http_code \n");
curl_close($handle);
return;
}

curl_close($handle);

?>