<?php
/**
 * Person.php
 *
 * @date 05.06.2016 16:02:13
 */

namespace Sufir;

/**
 * Person
 *
 * Персона.
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package Sufir
 */
final class Person
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var integer
     */
    protected $status;

    /**
     * @param string $name
     * @param integer $status
     */
    public function __construct($name, $status = 0)
    {
        $this->name = $name;
        $this->status = (int) $status;
    }

    /**
     * Возвращает имя.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Возвращает статус.
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Изменяет статус на противоположный.
     *
     * @return void
     */
    public function toggleStatus()
    {
        ($this->status) ? 0 : 1;
    }
}
