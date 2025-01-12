<?php

require_once('../../config.php');
require_once('lib.php');

$id = required_param('id', PARAM_INT); // ID course module.

$cm = get_coursemodule_from_id('longread', $id, 0, false, MUST_EXIST);
$course = get_course($cm->course);
$longread = $DB->get_record('longread', ['id' => $cm->instance], '*', MUST_EXIST);

require_login($course, true, $cm);

$context = context_module::instance($cm->id);
$PAGE->set_url('/mod/longread/view.php', ['id' => $id]);
$PAGE->set_title(format_string($longread->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);
$PAGE->set_cacheable(false);
$PAGE->requires->js_call_amd('mod_longread/longread', 'init');

$content = file_rewrite_pluginfile_urls(
    $longread->content,
    'pluginfile.php',
    $context->id,
    'mod_longread',
    'content',
    0
);
$pages = explode('<!--page-->', $content);

echo $OUTPUT->header();

echo html_writer::start_div('longread-container');
foreach ($pages as $index => $page) {
    $hidden_class = $index === 0 ? '' : 'hidden-page';
    echo html_writer::div($page, 'longread-page ' . $hidden_class, ['data-page' => $index]);
}
echo html_writer::start_div('longread-navigation');
echo html_writer::tag('button', 'Previous', [
    'id' => 'prev-page',
    'class' => 'longread-nav',
    'disabled' => true,
]);
echo html_writer::tag('button', 'Next', [
    'id' => 'next-page',
    'class' => 'longread-nav',
]);
echo html_writer::end_div();
echo html_writer::end_div();

echo $OUTPUT->footer();