<?php
defined('MOODLE_INTERNAL') || die();

$plugin->component = 'local_longread';
$plugin->version = 2024011000; // Версия плагина.
$plugin->requires = 2022112800; // Требуемая версия Moodle.

// Подключение стилей.
$PAGE->requires->css(new moodle_url('/local/longread/styles/style.css'));