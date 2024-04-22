<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240421161456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, orders_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_BA388B7A76ED395 (user_id), UNIQUE INDEX UNIQ_BA388B7CFFE9AD6 (orders_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_line (id INT AUTO_INCREMENT NOT NULL, cart_id INT DEFAULT NULL, product_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_3EF1B4CF1AD5CDBF (cart_id), INDEX IDX_3EF1B4CF4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command_line (id INT AUTO_INCREMENT NOT NULL, orders_id INT NOT NULL, product_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_70BE1A7BCFFE9AD6 (orders_id), INDEX IDX_70BE1A7B4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_adress (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(50) NOT NULL, first_name VARCHAR(75) NOT NULL, address VARCHAR(100) NOT NULL, phone VARCHAR(10) NOT NULL, postal_code INT NOT NULL, city VARCHAR(100) NOT NULL, country VARCHAR(100) NOT NULL, INDEX IDX_ED291BEFA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, product_id INT DEFAULT NULL, lien VARCHAR(255) NOT NULL, alt VARCHAR(100) DEFAULT NULL, type VARCHAR(50) NOT NULL, size VARCHAR(25) NOT NULL, INDEX IDX_6A2CA10C12469DE2 (category_id), INDEX IDX_6A2CA10C4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, order_number BIGINT NOT NULL, valid TINYINT(1) NOT NULL, date DATETIME NOT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, available TINYINT(1) NOT NULL, slug VARCHAR(50) NOT NULL, feature_1 VARCHAR(255) NOT NULL, feature_2 VARCHAR(255) NOT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_description (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, quantity SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_description_product (product_description_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_6926FA825EF6E847 (product_description_id), INDEX IDX_6926FA824584665A (product_id), PRIMARY KEY(product_description_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, first_name VARCHAR(75) NOT NULL, phone VARCHAR(10) DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE cart_line ADD CONSTRAINT FK_3EF1B4CF1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE cart_line ADD CONSTRAINT FK_3EF1B4CF4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7BCFFE9AD6 FOREIGN KEY (orders_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7B4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE customer_adress ADD CONSTRAINT FK_ED291BEFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product_description_product ADD CONSTRAINT FK_6926FA825EF6E847 FOREIGN KEY (product_description_id) REFERENCES product_description (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_description_product ADD CONSTRAINT FK_6926FA824584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7CFFE9AD6');
        $this->addSql('ALTER TABLE cart_line DROP FOREIGN KEY FK_3EF1B4CF1AD5CDBF');
        $this->addSql('ALTER TABLE cart_line DROP FOREIGN KEY FK_3EF1B4CF4584665A');
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7BCFFE9AD6');
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7B4584665A');
        $this->addSql('ALTER TABLE customer_adress DROP FOREIGN KEY FK_ED291BEFA76ED395');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C12469DE2');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C4584665A');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product_description_product DROP FOREIGN KEY FK_6926FA825EF6E847');
        $this->addSql('ALTER TABLE product_description_product DROP FOREIGN KEY FK_6926FA824584665A');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_line');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE command_line');
        $this->addSql('DROP TABLE customer_adress');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_description');
        $this->addSql('DROP TABLE product_description_product');
        $this->addSql('DROP TABLE user');
    }
}
