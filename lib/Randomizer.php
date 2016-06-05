<?php
/**
 * Randomizer.php
 *
 * @date 05.06.2016 16:39:41
 * @copyright Sklyarov Alexey <sufir@mihailovka.info>
 */

namespace Sufir;

/**
 * Randomizer
 *
 * Description of Randomizer
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package Sufir
 */
interface Randomizer
{
    /**
     * Метод случайным образом выбирает и возвращает одну персону.
     *
     * @return Person
     * @throws PersonNotFound Если персона не найдена.
     */
    public function randomPerson();
}
