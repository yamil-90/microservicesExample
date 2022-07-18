<?php

use prodigyview\network\Curl;

include('vendor/autoload.php');

$host = '127.0.0.1:8080/server.php';

echo "\n**Start Restfull Tests\n\n";

// Get all entries
$curl = new Curl($host);
$curl->send('get');
echo $curl->getResponse();
echo "\n\n";

// Get Single entry
$curl = new Curl($host);
$curl->send('get', array('id' => 1));
echo $curl->getResponse();
echo "\n\n";

// Post an entry (fail)
$curl = new Curl($host);
$curl->send('post', array('POST' => 'CRfEATE'));
echo $curl->getResponse();
echo "\n\n";

// Post an entry (success)
$curl = new Curl($host);
$curl->send('post', array('name' => 'Fisrt Test', 'description' => 'description of producrt'));
echo $curl->getResponse();
echo "\n\n";

// Patch an entry
$curl = new Curl($host);
$curl-> send('put', array('id' => '1', 'title' => 'updated title'));
echo $curl->getResponse();
echo "\n\n";

// Delete an entry (fail)
$curl = new Curl($host);
$curl-> send('delete',array('delete' => 'me'));
echo $curl->getResponse();
echo "\n\n";

// Delete an entry (success)
$curl = new Curl($host);
$curl-> send('delete',array('id' => 1));
echo $curl->getResponse();
echo "\n\n";
