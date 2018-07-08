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
 * Quiz Password Change Admin Tool
 *
 * @package    tool_coursesummary
 * @copyright  2017 Colin Bernard {@link http://bclearningnetwork.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


// Standard GPL and phpdocs
require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('passchange_form.php');
require_once(__DIR__.'/locallib.php');

// Calls require_login and performs permission checks for admin pages
admin_externalpage_setup('coursesummary'); 

// Set up the page.
$title = get_string('pluginname', 'tool_coursesummary');
$pagetitle = $title;
$url = new moodle_url("/admin/tool/coursesummary/index.php");
$PAGE->set_url($url);
$PAGE->set_title($title);
$PAGE->set_heading($title);

$PAGE->requires->js( new moodle_url($CFG->wwwroot . '/admin/tool/coursesummary/ajax/onselect.js'));
 
 
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('heading', 'tool_coursesummary'));

$info = format_text(get_string('coursesummaryintro', 'tool_coursesummary'), FORMAT_MARKDOWN);
echo $OUTPUT->box($info);

$success_output = $PAGE->get_renderer('tool_coursesummary');

$mform = new passchange_form();

if ($fromform = $mform->get_data()) {
	// Process validated data
	// $mform->get_data() returns data posted in form
	$course = tool_coursesummary_get_course_string($fromform->course);
	$password = $fromform->password;

	// Check if update blank passwords checkbox was marked
	if (property_exists($fromform, "updateblank")) {
		tool_coursesummary_set_quiz_passwords($course, $password, true);
	} else {
		tool_coursesummary_set_quiz_passwords($course, $password);
	}

	// Render success message HTML
	$renderable = new \tool_coursesummary\output\success_html(get_string('success', 'tool_coursesummary'), $password, $course, get_string('to', 'tool_coursesummary'));
	echo $success_output->render($renderable);

	$mform->display();

} else {
	// This branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
	// or on the first display of the form

	// Display the form
	$mform->display();
}

 
echo $OUTPUT->footer();

?>