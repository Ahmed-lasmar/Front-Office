<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221209112707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offreemploi CHANGE description description VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE rate ADD user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F398D93D649 FOREIGN KEY (user) REFERENCES user (idUser)');
        $this->addSql('CREATE INDEX IDX_DFEC3F398D93D649 ON rate (user)');
        $this->addSql('ALTER TABLE user CHANGE Nom Nom VARCHAR(255) DEFAULT NULL, CHANGE Cin Cin VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE Nom Nom VARCHAR(255) NOT NULL, CHANGE Cin Cin VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offreemploi CHANGE description description VARCHAR(15000) NOT NULL');
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F398D93D649');
        $this->addSql('DROP INDEX IDX_DFEC3F398D93D649 ON rate');
        $this->addSql('ALTER TABLE rate DROP user');
    }
}
