<?php

require_once('../../config.php');

function longread_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = []) {
    if ($filearea !== 'content') {
        return false;
    }

    require_login($course, true, $cm);
    $itemid = array_shift($args);

    $fs = get_file_storage();
    $file = $fs->get_file($context->id, 'mod_longread', $filearea, $itemid, '/', $args[0]);

    if (!$file || $file->is_directory()) {
        return false;
    }

    send_stored_file($file, 0, 0, $forcedownload, $options);
}