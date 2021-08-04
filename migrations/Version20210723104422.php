<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210723104422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prix_med ADD medicament_id INT NOT NULL');
        $this->addSql('ALTER TABLE prix_med ADD CONSTRAINT FK_D5E80743AB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5E80743AB0D61F7 ON prix_med (medicament_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prix_med DROP FOREIGN KEY FK_D5E80743AB0D61F7');
        $this->addSql('DROP INDEX UNIQ_D5E80743AB0D61F7 ON prix_med');
        $this->addSql('ALTER TABLE prix_med DROP medicament_id');
    }
}
