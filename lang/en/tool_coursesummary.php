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
 * @copyright  2019 Colin Bernard {@link https://wcln.ca}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'Course Summary Overwrite';
$string['heading'] = 'Course Summary Overwrite';
$string['coursesummaryintro'] = 'Overwrites the course summaries for every course in a particular category. Note this only affects courses which are direct children of the selected category. If they are nested within another folder/category, you should choose the more specific category.';
$string['submit'] = 'Submit';
$string['categoryselect'] = 'Select a category';
$string['htmltext'] = "HTML for course summary";
$string['success'] = 'Course summaries updated for category \'{$a}\'.';
$string['failure_bold'] = 'Overwrite failed!';
$string['failure'] = 'An unexpected exception occurred, and the summaries could not be overwritten. Please contact the plugin maintainer for a solution.';
