<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240307141438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, assigned_employee_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, status_date DATE NOT NULL, payment_date DATETIME NOT NULL, deposit_date DATE NOT NULL, pickup_date DATE NOT NULL, total_price DOUBLE PRECISION NOT NULL, INDEX IDX_F5299398A76ED395 (user_id), INDEX IDX_F5299398AB391195 (assigned_employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_article (order_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_F440A72D8D9F6D38 (order_id), INDEX IDX_F440A72D7294869C (article_id), PRIMARY KEY(order_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_service (order_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_17E733998D9F6D38 (order_id), INDEX IDX_17E73399ED5CA9E6 (service_id), PRIMARY KEY(order_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398AB391195 FOREIGN KEY (assigned_employee_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_article ADD CONSTRAINT FK_F440A72D8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_article ADD CONSTRAINT FK_F440A72D7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_service ADD CONSTRAINT FK_17E733998D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_service ADD CONSTRAINT FK_17E73399ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEAB391195');
        $this->addSql('ALTER TABLE orders_article DROP FOREIGN KEY FK_F34F7C1D7294869C');
        $this->addSql('ALTER TABLE orders_article DROP FOREIGN KEY FK_F34F7C1DCFFE9AD6');
        $this->addSql('ALTER TABLE orders_service DROP FOREIGN KEY FK_10E8E8A9CFFE9AD6');
        $this->addSql('ALTER TABLE orders_service DROP FOREIGN KEY FK_10E8E8A9ED5CA9E6');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE orders_article');
        $this->addSql('DROP TABLE orders_service');
        $this->addSql('ALTER TABLE user ADD is_employee TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, assigned_employee_id INT DEFAULT NULL, status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, status_date DATE NOT NULL, payment_date DATETIME NOT NULL, deposit_date DATE NOT NULL, pickup_date DATE NOT NULL, total_price DOUBLE PRECISION NOT NULL, INDEX IDX_E52FFDEEA76ED395 (user_id), INDEX IDX_E52FFDEEAB391195 (assigned_employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE orders_article (orders_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_F34F7C1D7294869C (article_id), INDEX IDX_F34F7C1DCFFE9AD6 (orders_id), PRIMARY KEY(orders_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE orders_service (orders_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_10E8E8A9CFFE9AD6 (orders_id), INDEX IDX_10E8E8A9ED5CA9E6 (service_id), PRIMARY KEY(orders_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEAB391195 FOREIGN KEY (assigned_employee_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE orders_article ADD CONSTRAINT FK_F34F7C1D7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders_article ADD CONSTRAINT FK_F34F7C1DCFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders_service ADD CONSTRAINT FK_10E8E8A9CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders_service ADD CONSTRAINT FK_10E8E8A9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398AB391195');
        $this->addSql('ALTER TABLE order_article DROP FOREIGN KEY FK_F440A72D8D9F6D38');
        $this->addSql('ALTER TABLE order_article DROP FOREIGN KEY FK_F440A72D7294869C');
        $this->addSql('ALTER TABLE order_service DROP FOREIGN KEY FK_17E733998D9F6D38');
        $this->addSql('ALTER TABLE order_service DROP FOREIGN KEY FK_17E73399ED5CA9E6');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_article');
        $this->addSql('DROP TABLE order_service');
        $this->addSql('ALTER TABLE user DROP is_employee');
    }
}
