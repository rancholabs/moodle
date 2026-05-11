<?php
defined('MOODLE_INTERNAL') || die();

$functions = [
    'local_lms_report_get_lms_report' => [
        'classname'   => 'local_lms_report\external\get_lms_report',
        'methodname'  => 'execute',
        'classpath'   => '',
        'description' => 'Get LMS quiz and student report',
        'type'        => 'read',
        'ajax'        => false,
        'services'    => [MOODLE_OFFICIAL_MOBILE_SERVICE],
    ],
];

$services = [
    'LMS Report Service' => [
        'functions' => ['local_lms_report_get_lms_report'],
        'restrictedusers' => 0,
        'enabled' => 1,
        'shortname' => 'lms_report_service',
    ],
];
