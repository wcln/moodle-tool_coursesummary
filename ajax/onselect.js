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
 * Change quiz passwords by course
 *
 * @package    tool_coursesummary
 * @copyright  2017 Colin Bernard {@link http://bclearningnetwork.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


/**
 * Performs an AJAX call to set a text field to a course password when a course is selected.
 *
 */
require(['jquery'], function($) {
	select = document.getElementById("id_course");

	select.onchange = function() {
		
		var course = select.options[select.selectedIndex].value;

		$.ajax({
			url: "ajax/getpassword.ajax.php",
			method: "POST",
			data: {course_id: course}
		}).done(function(response) {
			document.getElementById("id_password").value = response['response'];
		});
	}
});

