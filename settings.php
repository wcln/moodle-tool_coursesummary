<?php

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    // Link to Quiz Password Change tool.
    $ADMIN->add('tools', new admin_externalpage('coursesummary',
        get_string('pluginname', 'tool_coursesummary'), "$CFG->wwwroot/$CFG->admin/tool/coursesummary/index.php"));

}
