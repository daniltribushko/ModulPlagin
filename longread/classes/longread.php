<?php
namespace local_longread;

defined('MOODLE_INTERNAL') || die();

class longread {
    public static function get_all_longreads() {
        global $DB;
        return $DB->get_records('local_longread');
    }

    public static function get_longread($id) {
        global $DB;
        return $DB->get_record('local_longread', ['id' => $id], '*', MUST_EXIST);
    }

    public static function create_longread($data) {
        global $DB;
        $data->timecreated = time();
        return $DB->insert_record('local_longread', $data);
    }

    public static function update_longread($data) {
        global $DB;
        return $DB->update_record('local_longread', $data);
    }

    public static function delete_longread($id) {
        global $DB;
        return $DB->delete_records('local_longread', ['id' => $id]);
    }
}
