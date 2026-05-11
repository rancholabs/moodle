<?php
defined('MOODLE_INTERNAL') || die();

$capabilities = [
    'local/manual_enrollment:enable' => [
        'riskbitmask' => RISK_CONFIG,
        'captype'     => 'write',
        'contextlevel'=> CONTEXT_COURSE,
        'archetypes'  => [
            'manager' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
        ],
    ],
];
