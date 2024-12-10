<?php
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_longread', get_string('pluginname', 'local_longread'));


    $ADMIN->add('localplugins', $settings);
}
