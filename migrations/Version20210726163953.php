<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210726163953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicament ADD uv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723A20447BC0 FOREIGN KEY (uv_id) REFERENCES devise (id)');
        $this->addSql('CREATE INDEX IDX_9A9C723A20447BC0 ON medicament (uv_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723A20447BC0');
        $this->addSql('DROP INDEX IDX_9A9C723A20447BC0 ON medicament');
        $this->addSql('ALTER TABLE medicament DROP uv_id');
    }
}
