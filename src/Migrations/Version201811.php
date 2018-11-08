<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 07/11/2018
 * Time: 10:49
 */

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version201811 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        exit('la');
        // TODO: Implement up() method.
    }

    public function down(Schema $schema)
    {
        exit('ici');
        // TODO: Implement down() method.
    }

    /**
     * Sets the container.
     */
    public function setContainer(ContainerInterface $container = null)
    {
        // TODO: Implement setContainer() method.
    }
}
