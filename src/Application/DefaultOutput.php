<?php
/**
 * DefaultOutput.php
 */

namespace Sufir\Application;

/**
 * DefaultOutput
 *
 * Description of DefaultOutput
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package Sufir\Application
 */
class DefaultOutput implements OutputInterface
{
    /**
     * @var resource
     */
    protected $stream;

    public function __construct()
    {
        $this->stream = fopen('php://output', 'w');
    }

    /**
     * {@inheritdoc}
     */
    public function write($message)
    {
        fwrite($this->stream, $message . PHP_EOL);
    }
}
