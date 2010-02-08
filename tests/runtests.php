<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-Type" content="text/html; charset=utf-8" />
    <head>
    <body>
<?php

require_once('spyc/spyc.php');
require_once('../src/Twitter/Autolink.php');
require_once('../src/Twitter/Extractor.php');

/* Test Autolinking */
$data = Spyc::YAMLLoad('../test-data/twitter-text-conformance/autolink.yml');
$autolinker = new Twitter_Autolink();
foreach ($data['tests'] as $testname => $tests) {
    echo "<h1>Autolink $testname Tests</h1>\n";
    echo "<ul>";
    foreach ($tests as $test) {
        echo "<li>" . $test['description'] . ' ... ';
        $linked = $autolinker->autolink($test['text']);
        if ($test['expected'] == $linked) {
            echo " <span style='color: green'>passed.</span></li>";
        } else {
            echo " <span style='color: red'>failed.</span>";
            echo "<pre>Original: " . htmlspecialchars($test['text']) . "\nExpected: " . htmlspecialchars($test['expected']) . "\nActual  : " . htmlspecialchars($linked) . "</pre>";
            echo "</li>";
        }
    }
    echo "</ul>";
}

/* Test Extraction */
$data = Spyc::YAMLLoad('../test-data/twitter-text-conformance/extract.yml');
$extractor = new Twitter_Extractor();

$testfunctions = array(
    'mentions' => 'extractMentionedScreennames',
    'replies' => 'extractReplyScreenname',
    'urls' =>  'extraclURLS',
    'hashtags' => 'extractHashtags'
    );


foreach ($data['tests'] as $testname => $tests) {
    echo "<h1>Extraction $testname Tests</h1>\n";
    $function = $testfunctions[$testname];

    echo "<ul>";
    foreach ($tests as $test) {
        echo "<li>" . $test['description'] . ' ... ';
        $extracted = $extractor->$function($test['text']);
        if ($test['expected'] == $extracted) {
            echo " <span style='color: green'>passed.</span></li>";
        } else {
            echo " <span style='color: red'>failed.</span>";
            echo "<pre>Original: " . htmlspecialchars($test['text']) . "\nExpected: " . print_r($test['expected'], true) . "\nActual  : " . print_r($extracted, true) . "</pre>";
        }
        echo "</li>";
    }
    echo "</ul>";
}


?>
    </body>
</html>
