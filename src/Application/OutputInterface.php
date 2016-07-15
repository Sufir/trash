<?php
/**
 * OutputInterface.php
 *
 * @date 15.07.2016 9:28:06
 * @copyright Sklyarov Alexey <sufir@mihailovka.info>
 */

namespace Sufir\Application;

/**
 * OutputInterface
 *
 * Description of OutputInterface
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package Sufir\Application
 */
interface OutputInterface
{
    /**
     * 
     * @param string $messages
     * @return void
     */
    public function write($messages);
}
