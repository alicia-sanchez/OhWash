<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231112184022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_article ADD servie_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE category_article ADD CONSTRAINT FK_C5E24E182A134B51 FOREIGN KEY (servie_id_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_C5E24E182A134B51 ON category_article (servie_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_article DROP FOREIGN KEY FK_C5E24E182A134B51');
        $this->addSql('DROP INDEX IDX_C5E24E182A134B51 ON category_article');
        $this->addSql('ALTER TABLE category_article DROP servie_id_id');
    }
}
