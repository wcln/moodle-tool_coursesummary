<?php

defined('MOODLE_INTERNAL') || die;

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');


/**
 * Returns list of categories
 * @return array
 */
function tool_coursesummary_get_categories() {
    global $DB;

    $categories = array();

    $sql = 'SELECT id, name
            FROM {course_categories}';

    $rows = $DB->get_records_sql($sql);

    foreach ($rows as $row) {
        $categories[$row->id] = $row->name;
    }

    return $categories;
}

/**
 * Apply a summary to courses in a category.
 * @param $category
 * @param $summary
 * @return void
 */
function tool_coursesummary_set_course_summaries($category, $summary) {
    global $DB;

    // update in database
    $params = array($summary, $category);

    $sql = 'UPDATE {course}
            SET summary=?
            WHERE {course}.category=?';

    $DB->execute($sql, $params);
}

function tool_coursesummary_get_category_name($id) {
  global $DB;

  $params = array($id);

  $sql = 'SELECT name FROM {course_categories} WHERE id=?';

  return $DB->get_record_sql($sql, $params)->name;
}
