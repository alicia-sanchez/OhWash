<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240222142315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders ADD assigned_employee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEAB391195 FOREIGN KEY (assigned_employee_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEEAB391195 ON orders (assigned_employee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEAB391195');
        $this->addSql('DROP INDEX IDX_E52FFDEEAB391195 ON orders');
        $this->addSql('ALTER TABLE orders DROP assigned_employee_id');
    }
}
