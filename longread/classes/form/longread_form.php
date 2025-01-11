<?php
namespace local_longread\form;

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/formslib.php");

class longread_form extends \moodleform {
    public function definition() {
        $mform = $this->_form;

        $mform->addElement('text', 'title', get_string('title', 'local_longread'));
        $mform->setType('title', PARAM_TEXT);
        $mform->addRule('title', null, 'required', null, 'client');

        $mform->addElement('editor', 'content', get_string('content', 'local_longread'));
        $mform->setType('content', PARAM_RAW);

        $this->add_action_buttons();
    }
}
