<?php
unset($CFG);
global $CFG;
$CFG = new stdClass();
$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = getenv('DB_PORT_3306_TCP_ADDR');
$CFG->dbname    = getenv('DB_ENV_MYSQL_DATABASE');
$CFG->dbuser    = getenv('DB_ENV_MYSQL_USER');
$CFG->dbpass    = getenv('DB_ENV_MYSQL_PASSWORD');
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array(
    'dbpersist' => false,
    'dbsocket'  => false,
    'dbport'    => getenv('DB_PORT_3306_TCP_PORT'),
    'dbhandlesoptions' => false,
    'dbcollation' => 'utf8mb4_unicode_ci',
);
$CFG->wwwroot   = getenv('MOODLE_URL');
$CFG->dataroot  = '/var/moodledata';
$CFG->directorypermissions = 02777;
$CFG->admin = 'admin';
if ( getenv('SSL_PROXY') == "true" ) {
    $CFG->sslproxy = true;
}
require_once(dirname(__FILE__) . '/lib/setup.php'); // Do not edit