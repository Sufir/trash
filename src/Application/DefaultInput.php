<?php
/**
 * DefaultInput.php
 */

namespace Sufir\Application;

/**
 * DefaultInput
 *
 * Description of DefaultInput
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package Sufir\Application
 */
class DefaultInput implements InputInterface
{
    /**
     * @var array
     */
    protected $arguments = [];

    public function __construct()
    {
        $rawArgs = $_SERVER['argv'];
        array_shift($rawArgs);

        foreach ($rawArgs as $arg) {
            if (preg_match('/^-(\w+)(?:=(.*))?$/', $arg, $matches)) {
                $name = $matches[1];
                $this->arguments[$name] = isset($matches[2]) ? $matches[2] : true;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getArgument($name)
    {
        return (isset($this->arguments[$name])) ? $this->arguments[$name] : null;
    }
}
