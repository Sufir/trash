<?php
/**
 * Application.php
 */

namespace Sufir;

use Sufir\Application\InputInterface;
use Sufir\Application\OutputInterface;

/**
 * Application
 *
 * Description of Application
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package Sufir
 */
class Application
{
    /**
     * @var ParserInterface
     */
    protected $parser;

    public function __construct(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    /**
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    public function run(InputInterface $input, OutputInterface $output)
    {
        $source = $input->getArgument('s');

        if (!file_exists($source) && !filter_var($source, FILTER_VALIDATE_URL)) {
            $output->write('Source not found: ' . $source);
            die;
        }

        $html = file_get_contents($source);

        $output->write('Words:');
        $output->write(var_export($this->parser->calcWords($html), true));

        $output->write('Links:');
        $output->write(var_export($this->parser->findLinks($html), true));

        $output->write('Images:');
        $output->write(var_export($this->parser->findImages($html), true));
    }
}
