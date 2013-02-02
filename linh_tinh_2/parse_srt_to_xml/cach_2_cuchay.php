
<?php
foreach( array_chunk( file( 'test.srt'), 4) as $entry) {
    list( $number, $time, $subtitle) = $entry;
    echo $number . '<br />';
    echo $time . '<br />';
    echo $subtitle . '<br />';
}
?>
