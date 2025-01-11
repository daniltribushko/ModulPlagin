<?php
require_once(__DIR__ . '/../../config.php');

$context = context_system::instance();
require_login();
require_capability('local/longread:view', $context);

$PAGE->set_url(new moodle_url('/local/longread/index.php'));
$PAGE->set_context($context);
$PAGE->set_title(get_string('pluginname', 'local_longread'));
$PAGE->set_heading(get_string('pluginname', 'local_longread'));

global $DB, $OUTPUT;

// Удаление лонгрида
$deleteid = optional_param('delete', 0, PARAM_INT);
if ($deleteid) {
    $DB->delete_records('local_longread', ['id' => $deleteid]);
    redirect(new moodle_url('/local/longread/index.php'));
}

// Получаем список всех лонгридов
$longreads = $DB->get_records('local_longread');

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('longread_list', 'local_longread'));

// Ссылка для создания нового лонгрида
echo html_writer::div(html_writer::link(
    new moodle_url('/local/longread/pages/edit.php'),
    get_string('create_longread', 'local_longread'),
    ['class' => 'btn btn-primary']
));

// Отображаем таблицу с лонгридами
if ($longreads) {
    $table = new html_table();
    $table->head = ['Заголовок', 'Дата создания', 'Действия'];
    foreach ($longreads as $longread) {
        $viewurl = new moodle_url('/local/longread/pages/read.php', ['id' => $longread->id]);
        $editurl = new moodle_url('/local/longread/pages/edit.php', ['id' => $longread->id]);
        $deleteurl = new moodle_url('/local/longread/index.php', ['delete' => $longread->id]);

        $actions = html_writer::link($viewurl, 'Посмотреть') . ' | ' .
                   html_writer::link($editurl, 'Редактировать') . ' | ' .
                   html_writer::link($deleteurl, 'Удалить', ['onclick' => "return confirm('Вы уверены, что хотите удалить?')"]);

        $table->data[] = [
            format_string($longread->title),
            userdate($longread->timecreated),
            $actions,
        ];
    }
    echo html_writer::table($table);
} else {
    echo html_writer::div('Лонгридов пока нет.');
}

echo $OUTPUT->footer();
