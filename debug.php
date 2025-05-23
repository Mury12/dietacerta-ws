
<?php


$fContents = file_get_contents("https://happyscribe.com");
$regEx = '/Happy Scribe/';
$matches = [];
preg_match_all($regEx, $fContents, $matches, PREG_OFFSET_CAPTURE);
echo sizeof($matches[0]);
