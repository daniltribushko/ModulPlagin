<?php
defined('MOODLE_INTERNAL') || die();

$capabilities = [
    'local/longread:addinstance' => [
        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => [
            'manager' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
        ],
    ],
    'local/longread:view' => [
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,  // Даем доступ всем пользователям
        'archetypes' => [
            'guest' => CAP_ALLOW,  // Разрешаем доступ гостям
            'student' => CAP_ALLOW,  // Разрешаем доступ студентам
            'teacher' => CAP_ALLOW,  // Разрешаем доступ преподавателям
            'editingteacher' => CAP_ALLOW,  // Разрешаем доступ преподавателям
            'manager' => CAP_ALLOW,  // Разрешаем доступ менеджерам
        ],
    ],
];

