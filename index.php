<?php

// Standard GPL and phpdocs
require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('coursesummary_form.php');
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

$mform = new coursesummary_form();

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
