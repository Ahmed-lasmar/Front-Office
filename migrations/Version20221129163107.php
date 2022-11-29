<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221129163107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rate (id INT AUTO_INCREMENT NOT NULL, offreemploi INT DEFAULT NULL, rating VARCHAR(255) NOT NULL, INDEX IDX_DFEC3F39A9B2BBFD (offreemploi), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F39A9B2BBFD FOREIGN KEY (offreemploi) REFERENCES offreemploi (id_offre)');
        $this->addSql('ALTER TABLE formation DROP Image');
        $this->addSql('ALTER TABLE offreemploi CHANGE description description VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F39A9B2BBFD');
        $this->addSql('DROP TABLE rate');
        $this->addSql('ALTER TABLE offreemploi CHANGE description description VARCHAR(500) NOT NULL');
        $this->addSql('ALTER TABLE formation ADD Image VARCHAR(255) NOT NULL');
    }
}
