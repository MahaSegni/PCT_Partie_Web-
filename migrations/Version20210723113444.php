<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210723113444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicament DROP tva');
        $this->addSql('ALTER TABLE prix_med DROP FOREIGN KEY FK_D5E80743AB0D61F7');
        $this->addSql('ALTER TABLE prix_med ADD tva DOUBLE PRECISION DEFAULT NULL, CHANGE medicament medicament INT DEFAULT NULL');
        $this->addSql('DROP INDEX uniq_d5e80743ab0d61f7 ON prix_med');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5E807439A9C723A ON prix_med (medicament)');
        $this->addSql('ALTER TABLE prix_med ADD CONSTRAINT FK_D5E80743AB0D61F7 FOREIGN KEY (medicament) REFERENCES medicament (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicament ADD tva DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE prix_med DROP FOREIGN KEY FK_D5E807439A9C723A');
        $this->addSql('ALTER TABLE prix_med DROP tva, CHANGE medicament medicament INT NOT NULL');
        $this->addSql('DROP INDEX uniq_d5e807439a9c723a ON prix_med');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5E80743AB0D61F7 ON prix_med (medicament)');
        $this->addSql('ALTER TABLE prix_med ADD CONSTRAINT FK_D5E807439A9C723A FOREIGN KEY (medicament) REFERENCES medicament (id)');
    }
}
