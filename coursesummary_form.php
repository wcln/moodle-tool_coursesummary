<?php

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir.'/formslib.php');
require_once(__DIR__.'/locallib.php');


class coursesummary_form extends moodleform {

    protected function definition() {
        global $CFG;

        $mform = $this->_form;

        $categories = tool_coursesummary_get_categories(); // get from lib
        $categories = array_reverse($categories, true);
        $categories[''] = get_string('choosedots');
        $categories = array_reverse($categories, true);

        $mform->addElement('select', 'category', get_string('categoryselect', 'tool_coursesummary'), $categories);
        $mform->setType('category', PARAM_RAW);
        $mform->addRule('category', get_string('required'), 'required', null);

        $mform->addElement('textarea', 'summary', get_string('htmltext', 'tool_coursesummary'), 'rows="15" cols="100"');
        $mform->setType('summary', PARAM_RAW);
        $mform->addRule('summary', get_string('required'), 'required', null);

        $this->add_action_buttons(false, get_string('submit', 'tool_coursesummary'));
    }

    public function validation($data, $files) {
        return array();
    }
}
