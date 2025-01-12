<?php

require_once('../../config.php');
require_once($CFG->libdir . '/formslib.php');

class longread_form extends moodleform {
    public function definition() {
        $mform = $this->_form;

        // Название лонгрида.
        $mform->addElement('text', 'name', get_string('longreadname', 'mod_longread'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');

        // Введение.
        $mform->addElement('editor', 'intro', get_string('longreadintro', 'mod_longread'));
        $mform->setType('intro', PARAM_RAW);

        // Контент лонгрида.
        $mform->addElement('textarea', 'content', get_string('longreadcontent', 'mod_longread'), 'rows="20" cols="80"');
        $mform->setType('content', PARAM_RAW);
        $mform->addRule('content', null, 'required', null, 'client');

        $this->add_action_buttons();
    }
}

$id = required_param('id', PARAM_INT);
$course = get_course($id);

require_login($course);
$context = context_course::instance($course->id);
require_capability('mod/longread:addinstance', $context);

$PAGE->set_url(new moodle_url('/mod/longread/add.php', ['id' => $id]));
$PAGE->set_context($context);
$PAGE->set_title(get_string('addlongread', 'mod_longread'));
$PAGE->set_heading($course->fullname);

$mform = new longread_form();

if ($mform->is_cancelled()) {
    redirect(new moodle_url('/course/view.php', ['id' => $course->id]));
} else if ($data = $mform->get_data()) {
    global $DB;

    // Очистка данных перед записью в базу.
    $data->name = clean_param($data->name, PARAM_TEXT);
    $data->intro = clean_param($data->intro['text'], PARAM_RAW);
    $data->content = clean_param($data->content, PARAM_RAW);

    // Добавление данных в базу.
    $data->course = $course->id;
    $data->timecreated = time();
    $data->timemodified = time();

    try {
        $DB->insert_record('longread', $data);
        redirect(new moodle_url('/mod/longread/view.php', ['id' => $course->id]), get_string('longreadadded', 'mod_longread'));
    } catch (dml_exception $e) {
        debugging('Error writing to database: ' . $e->getMessage(), DEBUG_DEVELOPER);
        throw new moodle_exception('databaseerror', 'error', '', $e->getMessage());
    }
}

echo $OUTPUT->header();
echo $mform->display();
echo $OUTPUT->footer();

?>