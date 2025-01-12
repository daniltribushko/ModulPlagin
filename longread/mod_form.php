<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/moodleform_mod.php');

class mod_longread_mod_form extends moodleform_mod {

    public function definition() {
        $mform = $this->_form;

        // Название лонгрида.
        $mform->addElement('text', 'name', get_string('name', 'mod_longread'), ['size' => '64']);
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        // Редактор контента.
        $mform->addElement('editor', 'content_editor', get_string('content', 'mod_longread'), null, [
            'maxfiles' => EDITOR_UNLIMITED_FILES, // Разрешить загрузку файлов.
            'noclean' => true, // Не очищать HTML.
            'trusttext' => true, // Доверять содержимому.
        ]);
        $mform->setType('content_editor', PARAM_RAW); // Сохранять контент как есть.
        $mform->addRule('content_editor', null, 'required', null, 'client');

        // Подсказка для разделения страниц.
        $mform->addElement('static', 'content_hint', '', get_string('content_hint', 'mod_longread'));

        // Стандартные элементы для модуля курса.
        $this->standard_coursemodule_elements();
        $this->add_action_buttons();
    }

    public function data_preprocessing(&$default_values) {
        if (isset($this->_instance) && $this->_instance) {
            $default_values['content_editor']['text'] = $default_values['content'];
            $default_values['content_editor']['format'] = FORMAT_HTML;

            // Сохраняем разбиение на страницы.
            if (strpos($default_values['content'], '<!--page-->') !== false) {
                $default_values['content_editor']['text'] = $default_values['content'];
            }
        }
    }
}