<?php

namespace local_lms_report\external;

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once("$CFG->libdir/externallib.php");

use external_api;
use external_function_parameters;
use external_value;
use external_multiple_structure;
use external_single_structure;

class get_lms_report extends external_api {

    public static function execute_parameters() {
        return new external_function_parameters([
            'courseids' => new external_multiple_structure(
                new external_value(PARAM_INT, 'Course ID')
            ),
            'from' => new external_value(PARAM_INT, 'Start time (timestamp)', VALUE_DEFAULT, 0),
            'to' => new external_value(PARAM_INT, 'End time (timestamp)', VALUE_DEFAULT, 0),
        ]);
    }
    public static function execute($courseids, $from = 0, $to = 0) {
        global $DB;

        $params = self::validate_parameters(self::execute_parameters(), [
            'courseids' => $courseids,
            'from' => $from,
            'to' => $to,
        ]);
        $context = \context_system::instance();
        self::validate_context($context);
        require_capability('local/lms_report:view', \context_system::instance());


        $quizReport = [];
        $studentData = [];

        foreach ($params['courseids'] as $courseid) {
            $quizzes = $DB->get_records('quiz', ['course' => $courseid]);
            $quizList = [];

            foreach ($quizzes as $quiz) {
                $where = "quiz = :quizid";
                $attemptparams = ['quizid' => $quiz->id];

                if ($params['from'] > 0) {
                    $where .= " AND timemodified >= :from";
                    $attemptparams['from'] = $params['from'];
                }

                if ($params['to'] > 0) {
                    $where .= " AND timemodified <= :to";
                    $attemptparams['to'] = $params['to'];
                }

                $attempts = $DB->get_records_select('quiz_attempts', $where, $attemptparams);
                $attemptList = [];

                foreach ($attempts as $attempt) {
                    $user = $DB->get_record('user', ['id' => $attempt->userid], 'id, username');
                    $attemptList[] = [
                        'id' => $attempt->id,
                        'userid' => $attempt->userid,
                        'username' => $user ? $user->username : '',
                        'state' => $attempt->state,
                        'sumgrades' => $attempt->sumgrades,
                        'timemodified' => $attempt->timemodified,
                    ];
                }

                $quizList[] = [
                    'quizid' => $quiz->id,
                    'quizname' => $quiz->name,
                    'attempts' => $attemptList,
                ];
            }

            $quizReport[] = [
                'courseid' => $courseid,
                'quizzes' => $quizList,
            ];
        }

        // Get all students
        $studentRoleId = 5;
        $sql = "SELECT u.id, u.username 
                FROM {user} u 
                JOIN {role_assignments} ra ON ra.userid = u.id 
                WHERE ra.roleid = :roleid";
        $students = $DB->get_records_sql($sql, ['roleid' => $studentRoleId]);

        // Session log data
        // $sessionRows = $DB->get_records_sql("
        //     SELECT l.id, l.userid, l.timecreated
        //     FROM {logstore_standard_log} l
        //     ORDER BY l.userid, l.timecreated
        // ");

        // $sessionMap = [];
        // foreach ($sessionRows as $row) {
        //     $sessionMap[$row->userid][] = [
        //         'id' => $row->id,
        //         'timecreated' => $row->timecreated,
        //     ];
        // }

        $sessionMap = [];

        $oneyearago = time() - (365 * DAYSECS);
        $start = $oneyearago;
        $end = time();

        // chunk window: 30 days
        $chunk = 30 * DAYSECS;

        while ($start < $end) {

            $chunkend = min($start + $chunk, $end);

            $sessionRows = $DB->get_records_sql("
                SELECT
                    l.id,
                    l.userid,
                    l.timecreated
                FROM {logstore_standard_log} l
                WHERE l.timecreated BETWEEN :from AND :to
                ORDER BY l.userid, l.timecreated
            ", [
                'from' => $start,
                'to'   => $chunkend
            ]);


            foreach ($sessionRows as $row) {
                $sessionMap[$row->userid][] = [
                    'id' => (int)$row->id,
                    'timecreated' => (int)$row->timecreated,
                ];
            }

            // move window forward
            $start = $chunkend;
        }


        foreach ($students as $student) {
            $userid = $student->id;
            $attemptssql = "
                SELECT qa.id AS attemptid, qa.quiz AS quizid, qa.sumgrades, qa.timemodified
                FROM {quiz_attempts} qa
                WHERE qa.userid = :userid
            ";
            $attemptsparams = ['userid' => $userid];

            if ($params['from'] > 0) {
                $attemptssql .= " AND qa.timemodified >= :from";
                $attemptsparams['from'] = $params['from'];
            }

            if ($params['to'] > 0) {
                $attemptssql .= " AND qa.timemodified <= :to";
                $attemptsparams['to'] = $params['to'];
            }

            $attempts = $DB->get_records_sql($attemptssql, $attemptsparams);

            $loginLogs = $DB->get_records('logstore_standard_log', [
                'userid' => $userid,
                'eventname' => '\\core\\event\\user_loggedin'
            ]);

            $studentData[$userid] = [
                'userid' => $userid,
                'username' => $student->username,
                'logins' => array_values($loginLogs),
                'sessionlogs' => $sessionMap[$userid] ?? [],
                'attempts' => array_values($attempts),
            ];
        }

        return [
            'quizReport' => $quizReport,
            'studentReport' => array_values($studentData),
        ];
    }

    public static function execute_returns() {
        return new external_single_structure([
            'quizReport' => new external_multiple_structure(
                new external_single_structure([
                    'courseid' => new external_value(PARAM_INT, 'Course ID'),
                    'quizzes' => new external_multiple_structure(
                        new external_single_structure([
                            'quizid' => new external_value(PARAM_INT, 'Quiz ID'),
                            'quizname' => new external_value(PARAM_RAW, 'Quiz Name'),
                            'attempts' => new external_multiple_structure(
                                new external_single_structure([
                                    'id' => new external_value(PARAM_INT, 'Attempt ID'),
                                    'userid' => new external_value(PARAM_INT, 'User ID'),
                                    'username' => new external_value(PARAM_RAW, 'Username'),
                                    'state' => new external_value(PARAM_TEXT, 'Attempt State'),
                                    'sumgrades' => new external_value(PARAM_FLOAT, 'Grades'),
                                    'timemodified' => new external_value(PARAM_INT, 'Time Modified'),
                                ])
                            )
                        ])
                    )
                ])
            ),
            'studentReport' => new external_multiple_structure(
                new external_single_structure([
                    'userid' => new external_value(PARAM_INT, 'User ID'),
                    'username' => new external_value(PARAM_RAW, 'Username'),
                    'logins' => new external_multiple_structure(
                        new external_single_structure([
                            'id' => new external_value(PARAM_INT, 'Log ID'),
                            'eventname' => new external_value(PARAM_TEXT, 'Event Name'),
                            'timecreated' => new external_value(PARAM_INT, 'Time Created'),
                            'ip' => new external_value(PARAM_RAW, 'IP address', VALUE_OPTIONAL),
                        ])
                    ),
                    'sessionlogs' => new external_multiple_structure(
                        new external_single_structure([
                            'id' => new external_value(PARAM_INT, 'Session Log ID'),
                            'timecreated' => new external_value(PARAM_INT, 'Time Created'),
                        ])
                    ),
                    'attempts' => new external_multiple_structure(
                        new external_single_structure([
                            'quizid' => new external_value(PARAM_INT, 'Quiz ID'),
                            'attemptid' => new external_value(PARAM_INT, 'Attempt ID'),
                            'sumgrades' => new external_value(PARAM_FLOAT, 'Grades'),
                            'timemodified' => new external_value(PARAM_INT, 'Time Modified'),
                        ])
                    )
                ])
            )
        ]);
    }
}
