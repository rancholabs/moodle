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
 * TODO describe file ranchohome
 *
 * @package    theme_academi
 * @copyright  2024 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 defined('MOODLE_INTERNAL') || die();

 require_once(dirname(__FILE__) .'/includes/layoutdata.php');
 require_once(dirname(__FILE__) .'/includes/homeslider.php');
 
 $PAGE->requires->css(new moodle_url('/theme/academi/style/slick.css'));
 $PAGE->requires->js_call_amd('theme_academi/frontpage', 'init');
 $bodyattributes = $OUTPUT->body_attributes($extraclasses);
 $PAGE->requires->css('/style/external_page.css');
 // Jumbotron class.
 $jumbotronclass = (!empty(theme_academi_get_setting('jumbotronstatus'))) ? 'jumbotron-element' : '';
 // Slide show contnet added in the templatecontext.
 $templatecontext += $sliderconfig;

 // Carousel data

$logintoken = \core\session\manager::get_login_token();

// Add custom CSS
echo '<style>
    #page-wrapper {
        margin-top: 0px !important;
    }
</style>';

$trydemocontext = [
    'output' => $OUTPUT,
    'bodyattributes' => $bodyattributes,
    'logintoken' => $logintoken,
    'domain' => $CFG->wwwroot,
];

// *** Start Output Buffering ***
ob_start();
?>

<?php

$frontendAPI = getenv('FrontendAPI');
$schoolName = getenv('SchoolName');
// Construct the iframe URL with the unique token for the current user
$iframe_url =  $frontendAPI . '/home?schoolName=' . $schoolName;

// Output the iframe with the dynamically generated JWT token
echo html_writer::tag('iframe', '', [
    'src' => $iframe_url,
    'width' => '100%',
    'height' => 'calc(100% - 100px)', // Adjust height to account for the banner
    'style' => 'border: none; position: absolute; top: 0px; left: 0; z-index: 0;padding-top:60px;', // Positioning the iframe
    'frameborder' => '0',
    'allowfullscreen' => 'true'
]);

?>

<?php
// *** End Output Buffering & Capture Content ***
$custom_html_content = ob_get_clean();

$templatecontext += [
    'bodyattributes' => $bodyattributes,
    'jumbotronclass' => $jumbotronclass,
    'custom_main_content' => $custom_html_content,
];
echo $OUTPUT->render_from_template('theme_academi/ranchohome', $templatecontext);    