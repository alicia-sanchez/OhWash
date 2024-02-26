<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240215193618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders_article (orders_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_F34F7C1DCFFE9AD6 (orders_id), INDEX IDX_F34F7C1D7294869C (article_id), PRIMARY KEY(orders_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders_article ADD CONSTRAINT FK_F34F7C1DCFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders_article ADD CONSTRAINT FK_F34F7C1D7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders_article DROP FOREIGN KEY FK_F34F7C1DCFFE9AD6');
        $this->addSql('ALTER TABLE orders_article DROP FOREIGN KEY FK_F34F7C1D7294869C');
        $this->addSql('DROP TABLE orders_article');
    }
}
