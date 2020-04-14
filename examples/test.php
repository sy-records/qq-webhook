<?php

include __DIR__ . "/../src/Robot.php";

use Luffy\QQWebHook\Robot;

$key = "";
$robot = Robot::getInstance($key);
$robot->send("沈唁志博客\r\nhttps://qq52o.me");