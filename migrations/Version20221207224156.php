<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207224156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entretien ADD evaluation INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT FK_2B58D6DA1323A575 FOREIGN KEY (evaluation) REFERENCES evaluation (id_evaluation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2B58D6DA1323A575 ON entretien (evaluation)');
        $this->addSql('ALTER TABLE evaluation ADD entretien INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A5752B58D6DA FOREIGN KEY (entretien) REFERENCES entretien (id_entretien)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1323A5752B58D6DA ON evaluation (entretien)');
        $this->addSql('ALTER TABLE offreemploi CHANGE description description VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE Nom Nom VARCHAR(255) DEFAULT NULL, CHANGE Cin Cin VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A5752B58D6DA');
        $this->addSql('DROP INDEX UNIQ_1323A5752B58D6DA ON evaluation');
        $this->addSql('ALTER TABLE evaluation DROP entretien');
        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY FK_2B58D6DA1323A575');
        $this->addSql('DROP INDEX UNIQ_2B58D6DA1323A575 ON entretien');
        $this->addSql('ALTER TABLE entretien DROP evaluation');
        $this->addSql('ALTER TABLE offreemploi CHANGE description description VARCHAR(15000) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE Nom Nom VARCHAR(255) NOT NULL, CHANGE Cin Cin VARCHAR(255) NOT NULL');
    }
}
