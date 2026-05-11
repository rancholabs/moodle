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
 * TODO describe file uintlib
 *
 * @package    theme_academi
 * @copyright  2024 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');

require_login();

/**
 * Get the previous unit in the course.
 *
 * @param int $currentunitid The current unit (course module) ID.
 * @param int $courseid The course ID.
 * @return object|null The previous unit as a course module object, or null if none exists.
 */
function get_previous_unit($currentunitid, $courseid) {
    global $DB;

    // Query to find the previous unit (course module) based on the current unit's ID.
    $sql = "SELECT cm.*
            FROM {course_modules} cm
            JOIN {modules} m ON cm.module = m.id
            WHERE cm.course = :courseid
            AND cm.id < :currentunitid
            ORDER BY cm.id DESC
            LIMIT 1";
    
    $params = [
        'courseid' => $courseid,
        'currentunitid' => $currentunitid
    ];

    return $DB->get_record_sql($sql, $params);
}

/**
 * Get the next unit in the course.
 *
 * @param int $currentunitid The current unit (course module) ID.
 * @param int $courseid The course ID.
 * @return object|null The next unit as a course module object, or null if none exists.
 */
function get_next_unit($currentunitid, $courseid) {
    global $DB;

    // Query to find the next unit (course module) based on the current unit's ID.
    $sql = "SELECT cm.*
            FROM {course_modules} cm
            JOIN {modules} m ON cm.module = m.id
            WHERE cm.course = :courseid
            AND cm.id > :currentunitid
            ORDER BY cm.id ASC
            LIMIT 1";
    
    $params = [
        'courseid' => $courseid,
        'currentunitid' => $currentunitid
    ];

    return $DB->get_record_sql($sql, $params);
}
