<?php
require_once(__DIR__ . '/../config.php'); // Load Moodle config
require_login(); // Ensure the user is logged in


//user token
$userInfo = new stdClass(); // Create a new stdClass object

$secretKey = getenv('RANCHOLABS_LOGIN_SECRET');

// Basic user information
$userInfo->id = $USER->id;
$userInfo->username = $USER->username;
$userInfo->firstname = $USER->firstname;
$userInfo->lastname = $USER->lastname;
$userInfo->email = $USER->email;

// Course information (if needed)
$userInfo->course = new stdClass();
$userInfo->course->id = $COURSE->id;
$userInfo->course->fullname = $COURSE->fullname;

// Create a JWT payload
$payload = [
    'iat' => time(),  // Issued at
    'exp' => time() + 3600, // Expiration time (1 hour)
    'user' => $userInfo
];

// Encode payload to JSON
$header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
$payload = json_encode($payload);

// Base64Url encode the header and payload
$base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
$base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

// Create the signature
$signature = hash_hmac('sha256', $base64UrlHeader . '.' . $base64UrlPayload, $secretKey, true);
$base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

// Create the JWT
$jwt = $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;

echo json_encode(["token"=>$jwt]);
exit;

?>