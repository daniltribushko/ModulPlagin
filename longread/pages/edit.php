<?php
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/../classes/form/longread_form.php');

$id = optional_param('id', 0, PARAM_INT);
$context = context_system::instance();

require_login();
require_capability('local/longread:edit', $context);

$PAGE->set_url(new moodle_url('/local/longread/pages/edit.php', ['id' => $id]));
$PAGE->set_context($context);
$PAGE->set_title('Редактировать лонгрид');

$mform = new \local_longread\form\longread_form();

if ($mform->is_cancelled()) {
    redirect(new moodle_url('/local/longread/index.php'));
} else if ($data = $mform->get_data()) {
    if ($id) {
        $data->id = $id;
        \local_longread\longread::update_longread($data);
    } else {
        \local_longread\longread::create_longread($data);
    }
    redirect(new moodle_url('/local/longread/index.php'));
}

echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();
