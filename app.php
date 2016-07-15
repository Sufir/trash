<?php
require __DIR__.'/vendor/autoload.php';

use Sufir\SimpleParser;
use Sufir\Application;
use Sufir\Application\DefaultOutput;
use Sufir\Application\DefaultInput;

(new Application(new SimpleParser()))
    ->run(new DefaultInput(), new DefaultOutput());