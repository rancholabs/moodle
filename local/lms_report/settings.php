<?php
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage(
        'local_lms_report',
        get_string('pluginname', 'local_lms_report')
    );

    $ADMIN->add('localplugins', $settings);
}
