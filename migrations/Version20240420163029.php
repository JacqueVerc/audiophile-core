<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240420163029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD category_name VARCHAR(100) NOT NULL, ADD feature_1 VARCHAR(255) DEFAULT NULL, ADD feature_2 VARCHAR(255) DEFAULT NULL, ADD box_product VARCHAR(75) DEFAULT NULL, ADD box_product_number INT DEFAULT NULL, ADD replace_product VARCHAR(75) DEFAULT NULL, ADD replace_product_number INT DEFAULT NULL, ADD manual_product VARCHAR(50) DEFAULT NULL, ADD manual_product_number INT DEFAULT NULL, ADD element_product VARCHAR(75) DEFAULT NULL, ADD travel_product VARCHAR(50) DEFAULT NULL, ADD element_product_number INT DEFAULT NULL, ADD travel_product_number INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP category_name, DROP feature_1, DROP feature_2, DROP box_product, DROP box_product_number, DROP replace_product, DROP replace_product_number, DROP manual_product, DROP manual_product_number, DROP element_product, DROP travel_product, DROP element_product_number, DROP travel_product_number');
    }
}
