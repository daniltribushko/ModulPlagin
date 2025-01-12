<?php

function longread_add_instance($data) {
    global $DB;

    $data->timecreated = time();
    $data->timemodified = $data->timecreated;

    // Получаем текст из редактора.
    $data->content = $data->content_editor['text']; // Только текст.
    
    return $DB->insert_record('longread', $data);
}

function longread_update_instance($data) {
    global $DB;

    $data->timemodified = time();
    $data->id = $data->instance;

    // Получаем текст из редактора.
    $data->content = $data->content_editor['text']; // Только текст.

    return $DB->update_record('longread', $data);
}