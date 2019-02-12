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

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir.'/formslib.php');
require_once(__DIR__.'/locallib.php');

class coursesummary_form extends moodleform {

    protected function definition() {
        global $CFG;

        $mform = $this->_form;

        // Get array of course categories.
        $categories = tool_coursesummary_get_categories();
        $categories = array_reverse($categories, true);
        $categories[''] = get_string('choosedots');
        $categories = array_reverse($categories, true);

        // Category select input.
        $mform->addElement('select', 'category', get_string('categoryselect', 'tool_coursesummary'), $categories);
        $mform->setType('category', PARAM_RAW);
        $mform->addRule('category', get_string('required'), 'required', null);

        // Course summary text area.
        $mform->addElement('textarea', 'summary', get_string('htmltext', 'tool_coursesummary'), 'rows="15" cols="100"');
        $mform->setType('summary', PARAM_RAW);
        $mform->addRule('summary', get_string('required'), 'required', null);

        // Submit button.
        $this->add_action_buttons(false, get_string('submit', 'tool_coursesummary'));
    }

    public function validation($data, $files) {
        // No validation required.
        return array();
    }
}
