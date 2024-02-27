<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240226210812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders_service (orders_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_10E8E8A9CFFE9AD6 (orders_id), INDEX IDX_10E8E8A9ED5CA9E6 (service_id), PRIMARY KEY(orders_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders_service ADD CONSTRAINT FK_10E8E8A9CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders_service ADD CONSTRAINT FK_10E8E8A9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders_service DROP FOREIGN KEY FK_10E8E8A9CFFE9AD6');
        $this->addSql('ALTER TABLE orders_service DROP FOREIGN KEY FK_10E8E8A9ED5CA9E6');
        $this->addSql('DROP TABLE orders_service');
    }
}
