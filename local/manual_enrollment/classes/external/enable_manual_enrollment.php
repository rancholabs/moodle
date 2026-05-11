<?php
namespace local_manual_enrollment\external;

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once("$CFG->libdir/externallib.php");

use external_api;
use external_function_parameters;
use external_value;
use external_single_structure;
use context_course;

class enable_manual_enrollment extends external_api {

    public static function execute_parameters() {
        return new external_function_parameters([
            'courseid' => new external_value(PARAM_INT, 'Course ID'),
        ]);
    }

    public static function execute($courseid) {
        global $DB;

        // Validate parameters
        $params = self::validate_parameters(
            self::execute_parameters(),
            ['courseid' => $courseid]
        );

        // Validate course
        $course = $DB->get_record('course', ['id' => $params['courseid']], '*', MUST_EXIST);

        // Context & capability
        $context = context_course::instance($course->id);
        self::validate_context($context);
        require_capability('enrol/manual:config', $context);

        // Already enabled?
        $instance = $DB->get_record('enrol', [
            'courseid' => $course->id,
            'enrol'    => 'manual',
        ]);

        if ($instance) {
            return [
                'status'  => true,
                'message' => 'Manual enrollment already enabled',
            ];
        }

        // Get student role
        $studentroleid = $DB->get_field(
            'role',
            'id',
            ['shortname' => 'student'],
            MUST_EXIST
        );

        // Create enrol instance
        $enrol = (object)[
            'courseid'     => $course->id,
            'enrol'        => 'manual',
            'status'       => ENROL_INSTANCE_ENABLED,
            'roleid'       => $studentroleid,
            'customint1'   => 0,
            'sortorder'    => 0,
            'timecreated'  => time(),
            'timemodified' => time(),
        ];

        $DB->insert_record('enrol', $enrol);

        return [
            'status'  => true,
            'message' => 'Manual enrollment enabled successfully',
        ];
    }

    public static function execute_returns() {
        return new external_single_structure([
            'status'  => new external_value(PARAM_BOOL, 'Operation status'),
            'message' => new external_value(PARAM_TEXT, 'Result message'),
        ]);
    }
}
