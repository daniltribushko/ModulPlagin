<?php
require_once(__DIR__ . '/../../config.php');

$id = required_param('id', PARAM_INT);
$context = context_system::instance();

require_login();
require_capability('local/longread:view', $context);

$longread = \local_longread\longread::get_longread($id);

$PAGE->set_url(new moodle_url('/local/longread/pages/read.php', ['id' => $id]));
$PAGE->set_context($context);
$PAGE->set_title($longread->title);
$PAGE->requires->js_call_amd('local_longread/longread', 'init');

echo $OUTPUT->header();
echo $OUTPUT->heading($longread->title);

$contentPages = explode('<!--pagebreak-->', $longread->content);
foreach ($contentPages as $page) {
    echo html_writer::div(format_text($page, FORMAT_HTML), 'longread-page', ['style' => 'display: none;']);
}

echo html_writer::div(
    html_writer::link('#', 'Назад', ['class' => 'btn', 'id' => 'prev']) . 
    html_writer::link('#', 'Вперёд', ['class' => 'btn', 'id' => 'next']),
    'navigation'
);

echo $OUTPUT->footer();
