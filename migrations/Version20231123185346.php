<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123185346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_service_service (category_service_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_7690941CCB42F998 (category_service_id), INDEX IDX_7690941CED5CA9E6 (service_id), PRIMARY KEY(category_service_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_service_service ADD CONSTRAINT FK_7690941CCB42F998 FOREIGN KEY (category_service_id) REFERENCES category_service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_service_service ADD CONSTRAINT FK_7690941CED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_service DROP name');
        $this->addSql('ALTER TABLE service CHANGE name name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_service_service DROP FOREIGN KEY FK_7690941CCB42F998');
        $this->addSql('ALTER TABLE category_service_service DROP FOREIGN KEY FK_7690941CED5CA9E6');
        $this->addSql('DROP TABLE category_service_service');
        $this->addSql('ALTER TABLE category_service ADD name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE service CHANGE name name VARCHAR(100) NOT NULL');
    }
}
