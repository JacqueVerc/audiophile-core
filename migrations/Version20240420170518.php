<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240420170518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_description_product (product_description_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_6926FA825EF6E847 (product_description_id), INDEX IDX_6926FA824584665A (product_id), PRIMARY KEY(product_description_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_description_product ADD CONSTRAINT FK_6926FA825EF6E847 FOREIGN KEY (product_description_id) REFERENCES product_description (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_description_product ADD CONSTRAINT FK_6926FA824584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_description DROP FOREIGN KEY FK_C1CBDE394584665A');
        $this->addSql('DROP INDEX IDX_C1CBDE394584665A ON product_description');
        $this->addSql('ALTER TABLE product_description DROP product_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_description_product DROP FOREIGN KEY FK_6926FA825EF6E847');
        $this->addSql('ALTER TABLE product_description_product DROP FOREIGN KEY FK_6926FA824584665A');
        $this->addSql('DROP TABLE product_description_product');
        $this->addSql('ALTER TABLE product_description ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_description ADD CONSTRAINT FK_C1CBDE394584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_C1CBDE394584665A ON product_description (product_id)');
    }
}
