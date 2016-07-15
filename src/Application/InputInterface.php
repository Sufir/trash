<?php
/**
 * InputInterface.php
 *
 * @date 15.07.2016 9:28:37
 * @copyright Sklyarov Alexey <sufir@mihailovka.info>
 */

namespace Sufir\Application;

/**
 * InputInterface
 *
 * Description of InputInterface
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package Sufir\Application
 */
interface InputInterface
{
    /**
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getArgument($name, $default = null);
}
