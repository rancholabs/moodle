<?php
defined('MOODLE_INTERNAL') || die();

$functions = [
    'local_manual_enrollment_enable_manual_enrollment' => [
        'classname'   => 'local_manual_enrollment\external\enable_manual_enrollment',
        'methodname'  => 'execute',
        'description' => 'Enable manual enrollment method for a course',
        'type'        => 'write',
        'ajax'        => false,
        'services'    => [MOODLE_OFFICIAL_MOBILE_SERVICE],
    ],
];

$services = [
    'Manual Enrollment Service' => [
        'functions' => [
            'local_manual_enrollment_enable_manual_enrollment',
        ],
        'restrictedusers' => 0,
        'enabled' => 1,
        'shortname' => 'manual_enrollment_service',
    ],
];
