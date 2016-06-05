<?php
/**
 * CsvDataSource.php
 *
 * @date 05.06.2016 15:01:54
 */

namespace Sufir;

use Sufir\Exceptions\SourceNotExists;

/**
 * CsvDataSource
 *
 * Description of CsvDataSource
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package Sufir
 */
class CsvDataSource implements DataSource, Randomizer
{
    /**
     * @var string
     */
    protected $filename;
    /**
     * @var Person[]
     */
    protected $persons;
    /**
     * @var array
     */
    protected $headers = ['Имя', 'Статус'];

    /**
     * @param string $filename
     */
    function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @inheritdoc
     */
    public function fetchAll()
    {
        if (!$this->isSourceExists()) {
            throw new SourceNotExists("Wrong file name for data source {$this->filename}");
        }

        if ($this->persons === null) {
            $handle = fopen($this->filename, 'r');
            $this->headers = fgetcsv($handle, 0, ";");
            $this->persons = [];

            while (($entry = fgetcsv($handle, 0, ";")) !== FALSE) {
                $this->persons[$entry[0]] = new Person($entry[0], $entry[1]-0);
            }
            fclose($handle);
        }

        return array_values($this->persons);
    }

    /**
     * @inheritdoc
     */
    public function randomPerson()
    {
        if ($this->persons === null) {
            $this->fetchAll();
        }

        return $this->persons[array_rand($this->persons)];
    }

    /**
     * @inheritdoc
     */
    public function import(DataSource $dataSource)
    {
        $fp = fopen($this->filename, 'w');

        fputcsv($fp, $this->headers, ';');
        foreach ($dataSource->fetchAll() as $person) {
            fputcsv(
                $fp, [
                    $person->getName(),
                    $person->getStatus(),
                ],
                ';'
            );
        }

        fclose($fp);
    }

    /**
     * @inheritdoc
     */
    public function save(Person $person)
    {
        if ($this->persons === null) {
            $this->fetchAll();
        }

        $this->persons[$person->getName()] = new Person($person->getName(), ($person->getStatus()) ? 0 : 1);

        $fp = fopen($this->filename, 'w');

        fputcsv($fp, $this->headers, ';');
        foreach ($this->persons as $person) {
            fputcsv(
                $fp, [
                    $person->getName(),
                    $person->getStatus(),
                ],
                ';'
            );
        }

        fclose($fp);
    }

    /**
     * @inheritdoc
     */
    public function createSource()
    {
        if (!$this->isSourceExists()) {
            touch($this->filename);
        }
    }

    /**
     * @inheritdoc
     */
    public function isSourceExists()
    {
        return file_exists($this->filename);
    }
}
