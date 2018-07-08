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
 * Process AJAX request
 *
 * @package    tool_coursesummary
 * @copyright  2017 Colin Bernard {@link http://bclearningnetwork.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


if (!defined('AJAX_SCRIPT')) {
    define('AJAX_SCRIPT', true);
}

require_once(__DIR__ . '/../../../../config.php');
require_once(__DIR__.'/../locallib.php');

$course_id = required_param('course_id', PARAM_INT);

require_login();

$outcome = new stdClass;
$outcome->success = false;
$outcome->response = new stdClass;
$outcome->error = '';

$coursecontext = get_context_instance(CONTEXT_COURSE, $COURSE->id);
if (has_capability('moodle/site:config', $coursecontext)) {
	$course = tool_coursesummary_get_course_string($course_id);

	$params = array(1);
	$params[0] = $course;


	$result = $DB->get_record_sql('SELECT password FROM {course}, {quiz} WHERE {course}.id={quiz}.course AND {course}.fullname=? AND password<>"" AND password IS NOT NULL LIMIT 1', $params);

	$outcome->success = true;
	$outcome->response = $result->password;
} else {
	$outcome->error = 'You do not have access';
}

echo json_encode($outcome);
die;

