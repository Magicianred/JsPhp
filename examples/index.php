<?php
/**
 * @package Jhp
 * @author Sajeeb Ahamed <sajeeb07ahamed@gmail.com>
 * @copyright Copyright (c) 2020 Sajeeb Ahamed
 * @license MIT https://opensource.org/licenses/MIT
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Ahamed\JsPhp\JsArray;
use Ahamed\JsPhp\JsObject;

$object = new JsObject(['day' => 1, 'month' => 6, 'year' => 2020]);
$values = JsObject::entries($object);
