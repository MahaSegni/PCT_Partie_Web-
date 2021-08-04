<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210723095511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723A670C757F');
        $this->addSql('ALTER TABLE medicament ADD xpgroht DOUBLE PRECISION DEFAULT NULL, ADD xppharht DOUBLE PRECISION DEFAULT NULL, ADD xprixpubttc DOUBLE PRECISION DEFAULT NULL, ADD xprixphattc DOUBLE PRECISION DEFAULT NULL, CHANGE fournisseur fournisseur INT DEFAULT NULL');
        $this->addSql('DROP INDEX idx_9a9c723a670c757f ON medicament');
        $this->addSql('CREATE INDEX IDX_9A9C723A369ECA32 ON medicament (fournisseur)');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723A670C757F FOREIGN KEY (fournisseur) REFERENCES fournisseur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723A369ECA32');
        $this->addSql('ALTER TABLE medicament DROP xpgroht, DROP xppharht, DROP xprixpubttc, DROP xprixphattc, CHANGE fournisseur fournisseur INT NOT NULL');
        $this->addSql('DROP INDEX idx_9a9c723a369eca32 ON medicament');
        $this->addSql('CREATE INDEX IDX_9A9C723A670C757F ON medicament (fournisseur)');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723A369ECA32 FOREIGN KEY (fournisseur) REFERENCES fournisseur (id)');
    }
}
