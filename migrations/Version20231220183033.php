<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231220183033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service_category_articles (category_article_source INT NOT NULL, category_article_target INT NOT NULL, INDEX IDX_62B0D0C6D45DABCE (category_article_source), INDEX IDX_62B0D0C6CDB8FB41 (category_article_target), PRIMARY KEY(category_article_source, category_article_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_category_article (service_id INT NOT NULL, category_article_id INT NOT NULL, INDEX IDX_62A76909ED5CA9E6 (service_id), INDEX IDX_62A76909548AD6E2 (category_article_id), PRIMARY KEY(service_id, category_article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_service (service_source INT NOT NULL, service_target INT NOT NULL, INDEX IDX_2E19C84E614D7A45 (service_source), INDEX IDX_2E19C84E78A82ACA (service_target), PRIMARY KEY(service_source, service_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE service_category_articles ADD CONSTRAINT FK_62B0D0C6D45DABCE FOREIGN KEY (category_article_source) REFERENCES category_article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_category_articles ADD CONSTRAINT FK_62B0D0C6CDB8FB41 FOREIGN KEY (category_article_target) REFERENCES category_article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_category_article ADD CONSTRAINT FK_62A76909ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_category_article ADD CONSTRAINT FK_62A76909548AD6E2 FOREIGN KEY (category_article_id) REFERENCES category_article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_service ADD CONSTRAINT FK_2E19C84E614D7A45 FOREIGN KEY (service_source) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_service ADD CONSTRAINT FK_2E19C84E78A82ACA FOREIGN KEY (service_target) REFERENCES service (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_category_articles DROP FOREIGN KEY FK_62B0D0C6D45DABCE');
        $this->addSql('ALTER TABLE service_category_articles DROP FOREIGN KEY FK_62B0D0C6CDB8FB41');
        $this->addSql('ALTER TABLE service_category_article DROP FOREIGN KEY FK_62A76909ED5CA9E6');
        $this->addSql('ALTER TABLE service_category_article DROP FOREIGN KEY FK_62A76909548AD6E2');
        $this->addSql('ALTER TABLE service_service DROP FOREIGN KEY FK_2E19C84E614D7A45');
        $this->addSql('ALTER TABLE service_service DROP FOREIGN KEY FK_2E19C84E78A82ACA');
        $this->addSql('DROP TABLE service_category_articles');
        $this->addSql('DROP TABLE service_category_article');
        $this->addSql('DROP TABLE service_service');
    }
}
