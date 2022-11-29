<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221127143800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contrat ADD Id_Contrat INT AUTO_INCREMENT NOT NULL, DROP Id, ADD PRIMARY KEY (Id_Contrat)');
        $this->addSql('ALTER TABLE entretien ADD evaluation INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT FK_2B58D6DA1323A575 FOREIGN KEY (evaluation) REFERENCES evaluation (id_evaluation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2B58D6DA1323A575 ON entretien (evaluation)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contrat MODIFY Id_Contrat INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON contrat');
        $this->addSql('ALTER TABLE contrat ADD Id INT NOT NULL, DROP Id_Contrat');
        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY FK_2B58D6DA1323A575');
        $this->addSql('DROP INDEX UNIQ_2B58D6DA1323A575 ON entretien');
        $this->addSql('ALTER TABLE entretien DROP evaluation');
    }
}
