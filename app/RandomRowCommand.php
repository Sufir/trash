<?php
/**
 * RandomRowCommand.php
 *
 * @date 05.06.2016 14:33:04
 */

namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception\ConnectionException;
use Sufir\Exceptions\SourceNotExists;
use Sufir\Exceptions\PersonNotFound;
use Sufir\CsvDataSource;
use Sufir\MySqlDataSource;

/**
 * RandomRowCommand
 *
 * Description of RandomRowCommand
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package App
 */
class RandomRowCommand extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('test:random')
            ->setDescription('Get random row')
            ->addArgument(
                'user',
                InputArgument::OPTIONAL,
                'DB user'
            )
            ->addArgument(
                'password',
                InputArgument::OPTIONAL,
                'DB password'
            )
            ->addArgument(
                'db',
                InputArgument::OPTIONAL,
                'DB name',
                'majesty'
            )
            ->addArgument(
                'host',
                InputArgument::OPTIONAL,
                'DB host',
                'localhost'
            )
            ->addArgument(
                'port',
                InputArgument::OPTIONAL,
                'DB port',
                3306
            )
            ->addArgument(
                'source',
                InputArgument::OPTIONAL,
                'Data source file',
                'test.csv'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $connectionParams = array(
            'dbname' => $input->getArgument('db'),
            'user' => $input->getArgument('user'),
            'password' => $input->getArgument('password'),
            'host' => $input->getArgument('host'),
            'port' => $input->getArgument('port'),
            'driver' => 'pdo_mysql',
        );

        try {
            $db = DriverManager::getConnection($connectionParams);
            $destination = new MySqlDataSource($db);
        } catch (ConnectionException $exc) {
            $output->write('DB error: ' . $exc->getMessage());
            die;
        }

        $source = new CsvDataSource($input->getArgument('source'));

        try {
            $person = $destination->randomPerson();
        } catch (SourceNotExists $exc) {
            $destination->createSource();
            $destination->import($source);
            $person = $destination->randomPerson();
        } catch (PersonNotFound $exc) {
            $destination->import($source);
            $person = $destination->randomPerson();
        }

        $person->toggleStatus();
        $destination->save($person);

        $output->write('Random person: ' . $person->getName() . ';' . $person->getStatus());
    }
}
