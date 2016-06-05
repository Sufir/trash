<?php
/**
 * DataSource.php
 *
 * @date 05.06.2016 14:59:45
 * @copyright Sklyarov Alexey <sufir@mihailovka.info>
 */

namespace Sufir;

/**
 * DataSource
 *
 * Интерфейс источника данных.
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package Sufir
 */
interface DataSource
{
    /**
     * Метод возвращает коллекцию персон.
     *
     * @return Person[]
     */
    public function fetchAll();

    /**
     * Импорт данных из другого источника.
     * Внимание, уже существующие данные будут перезаписаны!
     *
     * @param \Sufir\DataSource $dataSource
     * @return void
     */
    public function import(DataSource $dataSource);

    /**
     *
     * @param \Sufir\Person $person
     * @return Person
     */
    public function save(Person $person);

    /**
     * Проверяет существование хранилища.
     *
     * @return boolean
     */
    public function isSourceExists();

    /**
     * Пытается создать хранилище, если не существует.
     *
     * @return void
     */
    public function createSource();
}
