<?php
require_once(__DIR__ . '/../../config.php');

$PAGE->set_url(new moodle_url('/local/longread/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_longread'));
$PAGE->set_heading(get_string('pluginname', 'local_longread'));

echo $OUTPUT->header();
echo $OUTPUT->heading('Добро пожаловать в плагин Longread!');

echo html_writer::tag('p', 'Это базовая страница плагина Longread.');
echo html_writer::tag('p', 'Позже здесь появится функционал.');

echo $OUTPUT->footer();
