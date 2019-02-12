<?php

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('coursesummary_form.php');
require_once(__DIR__.'/locallib.php');

// Calls require_login and performs permission checks for admin pages.
admin_externalpage_setup('coursesummary');

// Set up the page.
$title = get_string('pluginname', 'tool_coursesummary');
$pagetitle = $title;
$url = new moodle_url("/admin/tool/coursesummary/index.php");
$PAGE->set_url($url);
$PAGE->set_title($title);
$PAGE->set_heading($title);

// Get the page renderer.
$renderer = $PAGE->get_renderer('tool_coursesummary');

// Output the page header.
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('heading', 'tool_coursesummary'));

// Output instructions text.
$info = format_text(get_string('coursesummaryintro', 'tool_coursesummary'), FORMAT_MARKDOWN);
echo $OUTPUT->box($info);

// Initialize the form.
$mform = new coursesummary_form();

// Check if the form was submitted.
if ($fromform = $mform->get_data()) {

	// Retrieve the category and summary.
	$category = $fromform->category;
	$summary = $fromform->summary;

	try {
		// Update the summaries.
		tool_coursesummary_set_course_summaries($category, $summary);

		// Render success message HTML
		$success_output = new \tool_coursesummary\output\success(tool_coursesummary_get_category_name($category), $summary);
		echo $renderer->render($success_output);

	} catch(Exception $e) {

		// Render failure message HTML.
		echo $renderer->render_failure(null);

	}

	// Display the form.
	$mform->display();

} else {

	// Display the form.
	$mform->display();
}

// Output the page footer.
echo $OUTPUT->footer();

?>
