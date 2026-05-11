<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * TODO describe file rancho_courses
 *
 * @package    theme_academi
 * @copyright  2024 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 defined('MOODLE_INTERNAL') || die();

require_once(dirname(__FILE__) .'/includes/layoutdata.php');

require_once($CFG->libdir . '/filelib.php');
require_once(__DIR__ . '/../lib.php');

require_login();

// Get the current user ID
$user_id = $USER->id;

// Retrieve courses that the user is enrolled in
$coursedata = enrol_get_users_courses($user_id, true, null, null);

// Create an array to hold the IDs of courses the user is enrolled in
$enrolled_course_ids = array_map(function($course) {
    return $course->id;
}, $coursedata);

$pagesize = theme_academi_get_setting('pagesize');
if ($pagesize == 'container') {
    $extraclasses[] = 'theme-container';
} else if ($pagesize == 'default') {
    $extraclasses[] = 'default-container';
} else if ($pagesize == 'custom') {
    $extraclasses[] = 'custom-container';
}

$bodyattributes = $OUTPUT->body_attributes($extraclasses);

$templatecontext += [
    'bodyattributes' => $bodyattributes,
];

// Get all top-level subject categories.
$categories = core_course_category::get_all();

$course_pairs = []; // Array to hold the course pairs.

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
$token = $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;

// foreach ($subject_categories as $subject_category) {
//     // Fetch the subcategories (Learn and Build).
//     $subcategories = $subject_category->get_children();

//     $category_idnumber = $subject_category->idnumber;
//     $category_description = format_text($subject_category->description, $subject_category->descriptionformat);

//     $learn_course = null;
//     $build_course = null;
//     $compete_course = null;

//     $ch = curl_init();

//     $url = 'https://api.rancholabs-lms.in/api/users/courseCompletion/'.$category_idnumber;

//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
//     curl_setopt($ch, CURLOPT_HTTPGET, true);    
//     curl_setopt($ch, CURLOPT_HTTPHEADER, [
//         'Authorization:Bearer '.$token
//     ]);  
    
//     $response = curl_exec($ch);

//     $data=null;
//     $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//     if($http_code==200 ){
//         $data=json_decode($response,true);
//     }

//     foreach ($subcategories as $subcategory) {
//         // Get courses in the subcategory using get_courses.
//         $courses = core_course_category::get($subcategory->id)->get_courses();

//         // Check if this is a Learn or Build category based on the category name.
//         if (strpos(strtolower($subcategory->name), 'learn') !== false) {
//             $learn_course = reset($courses); // Assuming one course per subcategory.
//         } elseif (strpos(strtolower($subcategory->name), 'build') !== false) {
//             $build_course = reset($courses); // Assuming one course per subcategory.
//         }elseif (strpos(strtolower($subcategory->name), 'compete') !== false) {
//             $compete_course = reset($courses); // Assuming one course per subcategory.
//         }
        
//     }

//     // Add the pair to the array if both Learn and Build courses are found.
//     if ($learn_course && $build_course && $compete_course) {
//                 $radius = 18; // Radius of the circle
//                 $circumference = 2 * M_PI * $radius;
//                 $percentage = $data['percentage'] ? $data['percentage'] : 0; // Your dynamic percentage
//                 $offset = $circumference - ($percentage / 100) * $circumference;


//         if (in_array($learn_course->id, $enrolled_course_ids) && in_array($build_course->id, $enrolled_course_ids) && in_array($compete_course->id, $enrolled_course_ids)) {
//             $course_pairs[] = [
//                 'subject' => $subject_category->name,
//                 'id' => $category_idnumber,
//                 'description' => $category_description,
//                 'learn' => $learn_course,
//                 'build' => $build_course,
//                 'compete' => $compete_course,
//                 'percentage' => $percentage,
//                 'circumference' => $circumference,
//                 'offset' => $offset,
//             ];
//         }
//     }

// }



foreach ($categories as $category) {

    $category_idnumber = $category->idnumber;
    $category_description = format_text(
        $category->description,
        $category->descriptionformat
    );

    // ✅ Get courses directly inside category
    $courses = core_course_category::get($category->id)->get_courses();

    foreach ($courses as $course) {

        // Optional: check if user is enrolled
        if (in_array($course->id, $enrolled_course_ids)) {

            $course_pairs[] = [
                'subject' => $category->name,
                'id' => $category_idnumber,
                'description' => $category_description,
                'course' => $course,
                'course_description' => strip_tags(format_text($course->summary, $course->summaryformat)),
            ];
        }
    }
}

// Now $course_pairs contains all the subjects and their paired Learn and Build courses.
$templatecontext['coursepairs'] = $course_pairs;

// Render the template
echo $OUTPUT->render_from_template('theme_academi/rancho_courses', $templatecontext);
