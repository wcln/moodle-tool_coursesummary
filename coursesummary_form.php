<?php

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir.'/formslib.php');
require_once(__DIR__.'/locallib.php');



class coursesummary_form extends moodleform {

    protected function definition() {
        global $CFG;

        $mform = $this->_form;

        $courses = tool_coursesummary_get_courses(); // get from lib
        $courses = array_reverse($courses, true);
        $courses[''] = get_string('choosedots');
        $courses = array_reverse($courses, true);

        $mform->addElement('select', 'course', get_string('courseselect', 'tool_coursesummary'), $courses);
        $mform->setType('course', PARAM_RAW);
        $mform->addRule('course', get_string('required'), 'required', null);

        $mform->addElement('text', 'password', get_string('passwordtext', 'tool_coursesummary'));
        $mform->setType('password', PARAM_NOTAGS);

        $mform->addElement('checkbox', 'updateblank', get_string('updateblank', 'tool_coursesummary'), get_string('enable', 'tool_coursesummary'));
        $mform->setType('updateblank', PARAM_BOOL);
        $mform->addHelpButton('updateblank', 'updateblank', 'tool_coursesummary');


        $this->add_action_buttons(false, get_string('submit', 'tool_coursesummary'));
    }

    public function validation($data, $files) {
        return array();
    }
}
