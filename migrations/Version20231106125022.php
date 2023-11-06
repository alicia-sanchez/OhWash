<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231106125022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, category_article_id INT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_23A0E66548AD6E2 (category_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE basket (id INT AUTO_INCREMENT NOT NULL, selection_id INT NOT NULL, quantity INT NOT NULL, total_price DOUBLE PRECISION NOT NULL, INDEX IDX_2246507BE48EFE78 (selection_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_article (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, user1_id INT NOT NULL, basket_id INT NOT NULL, status VARCHAR(255) NOT NULL, status_date DATE NOT NULL, payement_date DATETIME NOT NULL, deposit_date DATE NOT NULL, pickup_date DATE NOT NULL, total_price DOUBLE PRECISION NOT NULL, INDEX IDX_E52FFDEEA76ED395 (user_id), INDEX IDX_E52FFDEE56AE248B (user1_id), INDEX IDX_E52FFDEE1BE1FB52 (basket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE selection (id INT AUTO_INCREMENT NOT NULL, service_id_id INT NOT NULL, article_id_id INT NOT NULL, INDEX IDX_96A50CD7D63673B0 (service_id_id), INDEX IDX_96A50CD78F3EC46 (article_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, price_id INT NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_has_category_service (id INT AUTO_INCREMENT NOT NULL, service_id INT NOT NULL, categoryservice_id INT NOT NULL, INDEX IDX_74FA5D5DED5CA9E6 (service_id), INDEX IDX_74FA5D5D67A0DACB (categoryservice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, gender VARCHAR(100) NOT NULL, adress VARCHAR(255) NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66548AD6E2 FOREIGN KEY (category_article_id) REFERENCES category_article (id)');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BE48EFE78 FOREIGN KEY (selection_id) REFERENCES selection (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE56AE248B FOREIGN KEY (user1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE1BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id)');
        $this->addSql('ALTER TABLE selection ADD CONSTRAINT FK_96A50CD7D63673B0 FOREIGN KEY (service_id_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE selection ADD CONSTRAINT FK_96A50CD78F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE service_has_category_service ADD CONSTRAINT FK_74FA5D5DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service_has_category_service ADD CONSTRAINT FK_74FA5D5D67A0DACB FOREIGN KEY (categoryservice_id) REFERENCES category_service (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66548AD6E2');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507BE48EFE78');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE56AE248B');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE1BE1FB52');
        $this->addSql('ALTER TABLE selection DROP FOREIGN KEY FK_96A50CD7D63673B0');
        $this->addSql('ALTER TABLE selection DROP FOREIGN KEY FK_96A50CD78F3EC46');
        $this->addSql('ALTER TABLE service_has_category_service DROP FOREIGN KEY FK_74FA5D5DED5CA9E6');
        $this->addSql('ALTER TABLE service_has_category_service DROP FOREIGN KEY FK_74FA5D5D67A0DACB');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE basket');
        $this->addSql('DROP TABLE category_article');
        $this->addSql('DROP TABLE category_service');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE selection');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_has_category_service');
        $this->addSql('DROP TABLE user');
    }
}
