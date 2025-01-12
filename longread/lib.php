<?php
defined('MOODLE_INTERNAL') || die();

function longread_supports($feature) {
    switch ($feature) {
        case FEATURE_MOD_ARCHETYPE:
            return MOD_ARCHETYPE_RESOURCE;
        case FEATURE_SHOW_DESCRIPTION:
            return true;
        default:
            return null;
    }
}

function longread_add_instance($data) {
    global $DB;

    $data->timecreated = time();
    $data->timemodified = $data->timecreated;

    // Обработка контента из редактора.
    $data->content = $data->content['text']; // Получаем только текст из редактора.

    return $DB->insert_record('longread', $data);
}

function longread_view($course, $cm, $context) {
    global $PAGE;
    $PAGE->requires->js_call_amd('mod_longread/longread', 'init');
}

function longread_update_instance($data) {
    global $DB;

    $data->timemodified = time();
    $data->id = $data->instance;

    // Обработка контента из редактора.
    $data->content = $data->content['text']; // Получаем только текст из редактора.

    return $DB->update_record('longread', $data);
}
function longread_delete_instance($id) {
    global $DB;
    return $DB->delete_records('longread', ['id' => $id]);
}
