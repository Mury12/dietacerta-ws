<?php

/**
 * Extracts all the database tables to a MVCE architecture
 */

use MMWS\Handler\DatabaseModelExtractor;
use Dotenv\Dotenv;

/** Composer autoload */
require_once 'vendor/autoload.php';
require_once 'src/partials/_core/application/autoload.php';

/**
 * @var Dotenv\Dotenv $dotenv loads the environment variables in .env
 */
$dotenv = Dotenv::createImmutable('src/../');
$dotenv->load();

require_once 'src/config/db-conf.php';

$dbm = new DatabaseModelExtractor(DB_NAME, 'src/partials/classes', 1);

// It will set to only extract these tables
// $dbm->setTables(['table_1', 'table_2', 'table_3']);

// Starts 
$dbm->generate();
