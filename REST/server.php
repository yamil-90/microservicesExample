<?php


include ('vendor/autoload.php');

use prodigyview\network\Request;
use prodigyview\network\Response;


$entries = array(
 1 => array('name' => 'first entry', 'description' => 'first entry description'),
 2 => array('name' => 'second entry', 'description' => 'second entry description'),
 2 => array('name' => 'third entry', 'description' => 'third entry description'),
);

// get the request and the request method (get, post, put or delete)

$request = new Request();

$method = strtolower($request->getRequestMethod());

//RETRIEVE Data From The Request
$data = $request->getRequestData('array');

if ($method == 'get') {
 get($data);
} else if ($method == 'post') {
 post($data);
} else if ($method == 'put') {
 parse_str($data,$data);
 put($data);
} else if ($method == 'delete') {
 parse_str($data,$data);
 delete($data);
}

// Defined funcions

/**
 * Process all GET data to find information
 */
function get($data) {
	global $entries;
	
	$response  = array();
	
	if(isset($data['id']) && isset($entries[$data['id']])) {
		$response = $entries[$data['id']];
	} else {
		$response = $entries;
	}
	
	echo Response::createResponse(200, json_encode($response));
	exit();
};

/**
 * Process all POST data to create data
 */
function post($data) {
	global $entries;
	
	$response  = array();
	
	if(isset($data['name']) && isset($data['description'])) {
		$entries[] = $data;
		$response = array('status' => 'Entry Successfully Added');
	} else {
		$response = array('status' => 'Unable To Add Entry');
	}
	
	echo Response::createResponse(200, json_encode($response));
	exit();

};

/**
 * Process all PUT data to update information
 */
function put($data) {
	global $entries;
	
	$response  = array();
	
	if(isset($data['id']) && isset($entries[$data['id']])) {
		if(isset($data['name'])) {
			$entries[$data['id']]['name'] = $data['name'];
		}
		
		if(isset($data['description'])) {
			$entries[$data['id']]['description'] = $data['description'];
		}
		$response = array('status' => 'Entry Successfully Updated', 'content' => $entries[$data['id']]);
	} else {
		$response = array('status' => 'Unable To Update Entry');
	}
	
	echo Response::createResponse(200, json_encode($response));
	exit();

};

/**
 * Process DELETE to remove data
 */
function delete($data) {
	global $entries;
	
	$response  = array();
	
	if(isset($data['id']) && isset($entries[$data['id']])) {
		unset($entries[$data['id']]);
		$response = array('status' => 'Entry Deleted', 'content' => $entries);
	} else{
		$response = array('status' => 'Unable To Update Entry');
	}
	
	echo Response::createResponse(200, json_encode($response));
	exit();

};