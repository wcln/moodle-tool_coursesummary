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
 * Course Summary Overwrite Admin Tool
 *
 * @package    tool_coursesummary
 * @copyright  2019 Colin Perepelken {@link https://wcln.ca}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

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

    $rows = $DB->get_records_sql('SELECT id, name FROM {course_categories}');

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
    $DB->execute('UPDATE {course} SET summary = ? WHERE {course}.category = ?', array($summary, $category));
}

/**
 * Return a category name given an ID.
 * @param $id
 * @return string category name
 */
function tool_coursesummary_get_category_name($id) {
  global $DB;

  $category = $DB->get_record_sql('SELECT name FROM {course_categories} WHERE id = ?', array($id));

  if ($category) {
    return $category->name;
  } else {
    return '';
  }
}
