<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231109180405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE category_article ADD category_service_id INT NOT NULL');
        $this->addSql('ALTER TABLE category_article ADD CONSTRAINT FK_C5E24E18CB42F998 FOREIGN KEY (category_service_id) REFERENCES category_service (id)');
        $this->addSql('CREATE INDEX IDX_C5E24E18CB42F998 ON category_article (category_service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP description');
        $this->addSql('ALTER TABLE category_article DROP FOREIGN KEY FK_C5E24E18CB42F998');
        $this->addSql('DROP INDEX IDX_C5E24E18CB42F998 ON category_article');
        $this->addSql('ALTER TABLE category_article DROP category_service_id');
    }
}
