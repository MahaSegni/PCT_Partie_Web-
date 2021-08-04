<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210723091156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723A670C757F');
        $this->addSql('DROP INDEX IDX_9A9C723A670C757F ON medicament');
        $this->addSql('ALTER TABLE medicament CHANGE fournisseur fournisseur_id INT NOT NULL');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723A670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_9A9C723A670C757F ON medicament (fournisseur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723A670C757F');
        $this->addSql('DROP INDEX IDX_9A9C723A670C757F ON medicament');
        $this->addSql('ALTER TABLE medicament CHANGE fournisseur_id fournisseur INT NOT NULL');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723A670C757F FOREIGN KEY (fournisseur) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_9A9C723A670C757F ON medicament (fournisseur)');
    }
}
