
<?php
define('SRT_STATE_SUBNUMBER', 0);
define('SRT_STATE_TIME',      1);
define('SRT_STATE_TEXT',      2);
define('SRT_STATE_BLANK',     3);

$lines   = file('test.srt');

$subs    = array();
$state   = SRT_STATE_SUBNUMBER;
$subNum  = 0;
$subText = '';
$subTime = '';

foreach($lines as $line) {
    switch($state) {
        case SRT_STATE_SUBNUMBER:
            $subNum = trim($line);
            $state  = SRT_STATE_TIME;
            break;

        case SRT_STATE_TIME:
            $subTime = trim($line);
            $state   = SRT_STATE_TEXT;
            break;

        case SRT_STATE_TEXT:
            if (trim($line) == '') {
                $sub = new stdClass;
                $sub->number = $subNum;
                list($sub->startTime, $sub->stopTime) = explode(' --> ', $subTime);
                $sub->text   = $subText;
                $subText     = '';
                $state       = SRT_STATE_SUBNUMBER;

                $subs[]      = $sub;
            } else {
                $subText .= $line;
            }
            break;
    }
}
echo "<pre>";
print_r($subs);
echo "</pre>";
foreach($subs as $sub){
	//echo $sub->number."<br/>";
}
?>
