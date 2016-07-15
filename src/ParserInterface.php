<?php
/**
 * ParserInterface.php
 *
 * @date 15.07.2016 7:16:31
 * @copyright Sklyarov Alexey <sufir@mihailovka.info>
 */

namespace Sufir;

/**
 * ParserInterface
 *
 * Description of ParserInterface
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package Sufir
 */
interface ParserInterface
{
    /**
     *
     * @param string $html
     * @return array
     */
    public function calcWords($html);

    /**
     *
     * @param string $html
     * @return array
     */
    public function findLinks($html);

    /**
     *
     * @param string $html
     * @return array
     */
    public function findImages($html);
}
