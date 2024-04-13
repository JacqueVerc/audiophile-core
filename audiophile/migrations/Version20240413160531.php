<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240413160531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_line ADD quantity INT NOT NULL');
        $this->addSql('ALTER TABLE category ADD name VARCHAR(100) NOT NULL, ADD description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE command_line ADD quantity INT NOT NULL');
        $this->addSql('ALTER TABLE customer_adress ADD name VARCHAR(50) NOT NULL, ADD first_name VARCHAR(75) NOT NULL, ADD address VARCHAR(100) NOT NULL, ADD phone VARCHAR(10) NOT NULL, ADD postal_code INT NOT NULL, ADD city VARCHAR(100) NOT NULL, ADD country VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD order_number BIGINT NOT NULL, ADD valid TINYINT(1) NOT NULL, ADD date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE product ADD name VARCHAR(100) NOT NULL, ADD description VARCHAR(255) NOT NULL, ADD price DOUBLE PRECISION NOT NULL, ADD available TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(50) NOT NULL, ADD first_name VARCHAR(75) NOT NULL, ADD phone VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP name, DROP first_name, DROP phone');
        $this->addSql('ALTER TABLE customer_adress DROP name, DROP first_name, DROP address, DROP phone, DROP postal_code, DROP city, DROP country');
        $this->addSql('ALTER TABLE `order` DROP order_number, DROP valid, DROP date');
        $this->addSql('ALTER TABLE category DROP name, DROP description');
        $this->addSql('ALTER TABLE cart_line DROP quantity');
        $this->addSql('ALTER TABLE command_line DROP quantity');
        $this->addSql('ALTER TABLE product DROP name, DROP description, DROP price, DROP available');
    }
}
