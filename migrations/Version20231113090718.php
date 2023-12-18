<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113090718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service_category_service (service_id INT NOT NULL, category_service_id INT NOT NULL, INDEX IDX_8100FDBDED5CA9E6 (service_id), INDEX IDX_8100FDBDCB42F998 (category_service_id), PRIMARY KEY(service_id, category_service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE service_category_service ADD CONSTRAINT FK_8100FDBDED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_category_service ADD CONSTRAINT FK_8100FDBDCB42F998 FOREIGN KEY (category_service_id) REFERENCES category_service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_article DROP FOREIGN KEY FK_C5E24E182A134B51');
        $this->addSql('DROP INDEX IDX_C5E24E182A134B51 ON category_article');
        $this->addSql('ALTER TABLE category_article CHANGE servie_id_id service_id INT NOT NULL');
        $this->addSql('ALTER TABLE category_article ADD CONSTRAINT FK_C5E24E18ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_C5E24E18ED5CA9E6 ON category_article (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_category_service DROP FOREIGN KEY FK_8100FDBDED5CA9E6');
        $this->addSql('ALTER TABLE service_category_service DROP FOREIGN KEY FK_8100FDBDCB42F998');
        $this->addSql('DROP TABLE service_category_service');
        $this->addSql('ALTER TABLE category_article DROP FOREIGN KEY FK_C5E24E18ED5CA9E6');
        $this->addSql('DROP INDEX IDX_C5E24E18ED5CA9E6 ON category_article');
        $this->addSql('ALTER TABLE category_article CHANGE service_id servie_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE category_article ADD CONSTRAINT FK_C5E24E182A134B51 FOREIGN KEY (servie_id_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_C5E24E182A134B51 ON category_article (servie_id_id)');
    }
}
