<?php
/**
 * MySqlDataSource.php
 *
 * @date 05.06.2016 16:44:43
 */

namespace Sufir;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Type;
use Sufir\Exceptions\PersonNotFound;
use Sufir\Exceptions\SourceNotExists;

/**
 * MySqlDataSource
 *
 * Description of MySqlDataSource
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package Sufir
 */
class MySqlDataSource implements DataSource, Randomizer
{
    /**
     * @var Connection
     */
    protected $db;
    /**
     * @var string
     */
    protected $table = 'persons';

    /**
     * @param Connection $db
     */
    function __construct(Connection $db)
    {
        $this->db = $db;

        if (!$this->db->isConnected()) {
            $this->db->connect();
        }
    }

    /**
     * @inheritdoc
     */
    public function randomPerson()
    {
        if (!$this->isSourceExists()) {
            throw new SourceNotExists("DB table `{$this->table}` not exists");
        }

        $result = $this->db->fetchAssoc("SELECT * FROM `{$this->table}` ORDER BY RAND() LIMIT 1");

        if (!$result) {
            throw new PersonNotFound('Persons not found');
        }

        return new Person($result['name'], $result['status']);
    }

    /**
     * @inheritdoc
     */
    public function fetchAll()
    {
        $persons = [];
        $stmt = $this->db->query("SELECT * FROM `{$this->table}` ORDER BY `name`");

        while ($entry = $stmt->fetch()) {
            $persons[] = new Person($entry['name'], $entry['status']-0);
        }

        return $persons;
    }

    /**
     * @inheritdoc
     */
    public function import(DataSource $dataSource)
    {
        $sql = "INSERT INTO `{$this->table}` (`name`, `status`) VALUES (:name, :status)";
        $stmt = $this->db->prepare($sql);
        foreach ($dataSource->fetchAll() as $entry) {
            $stmt->bindValue('name', $entry->getName(), Type::STRING);
            $stmt->bindValue('status', $entry->getStatus(), Type::SMALLINT);
            $stmt->execute();
        }
    }

    /**
     * @inheritdoc
     */
    public function save(Person $person)
    {
        $this->db->executeUpdate("UPDATE `persons` SET `status` = NOT `status` WHERE (`name`=:name)", ['name' => $person->getName()]);
    }

    /**
     * @return boolean
     */
    public function isSourceExists()
    {
        return !!$this->db->fetchColumn("SHOW TABLES LIKE 'persons'");
    }

    /**
     * @return void
     */
    public function createSource()
    {
        if (!$this->isSourceExists()) {
            $this->db->executeQuery("CREATE TABLE `persons` (
                `name`  varchar(255) NOT NULL PRIMARY KEY,
                `status`  smallint(1) NULL DEFAULT 0
            )");
        }
    }
}
