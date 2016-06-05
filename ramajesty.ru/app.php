<?php
require __DIR__.'/vendor/autoload.php';

use App\RandomRowCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new RandomRowCommand());
$application->run();