<?php
require_once(__DIR__ . '/../../config.php'); // Load Moodle config
require_login(); // Ensure the user is logged in

// Set up the page
$PAGE->set_url('/local/plugin_compete/index.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_cacheable(false); // Disable page caching

// Custom CSS for the iframe to remove margins/padding and make it full-screen
$PAGE->requires->css('/style/external_page.css');

// Output the header
echo $OUTPUT->header();

// Generate a unique token for the logged-in user
$userInfo = new stdClass(); // Create a new stdClass object

$secretKey = 'rancholabsxloginxsystemxquizxproductsha256';

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
    'iat' => time(),  // Issued at time
    'exp' => time() + 3600, // Expiration time (1 hour from now)
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

$frontendAPI = getenv('FrontendAPI');
// Construct the iframe URL with the unique token for the current user
$iframe_url =  $frontendAPI . '/competition?token=' . $jwt . '&user=' . urlencode($userInfo->username);

// Output the iframe with the dynamically generated JWT token
echo html_writer::tag('iframe', '', [
    'src' => $iframe_url,
    'width' => '100%',
    'height' => 'calc(100% - 100px)', // Adjust height to account for the banner
    'style' => 'border: none; position: absolute; top: 0px; left: 0; z-index: 0;', // Positioning the iframe
    'frameborder' => '0',
    'allowfullscreen' => 'true'
]);

// Output the footer
echo $OUTPUT->footer();
