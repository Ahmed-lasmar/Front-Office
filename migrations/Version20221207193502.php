<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207193502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, formation INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C53D045F404021BF (formation), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F404021BF FOREIGN KEY (formation) REFERENCES formation (Id_For)');
        $this->addSql('ALTER TABLE candidat CHANGE Competence Competence VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY FK_2B58D6DA1323A575');
        $this->addSql('DROP INDEX UNIQ_2B58D6DA1323A575 ON entretien');
        $this->addSql('ALTER TABLE entretien DROP evaluation');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A5752B58D6DA');
        $this->addSql('DROP INDEX UNIQ_1323A5752B58D6DA ON evaluation');
        $this->addSql('ALTER TABLE evaluation DROP entretien');
        $this->addSql('ALTER TABLE offreemploi CHANGE description description VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F404021BF');
        $this->addSql('DROP TABLE image');
        $this->addSql('ALTER TABLE entretien ADD evaluation INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT FK_2B58D6DA1323A575 FOREIGN KEY (evaluation) REFERENCES evaluation (id_evaluation) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2B58D6DA1323A575 ON entretien (evaluation)');
        $this->addSql('ALTER TABLE evaluation ADD entretien INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A5752B58D6DA FOREIGN KEY (entretien) REFERENCES entretien (id_entretien) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1323A5752B58D6DA ON evaluation (entretien)');
        $this->addSql('ALTER TABLE offreemploi CHANGE description description VARCHAR(15000) NOT NULL');
        $this->addSql('ALTER TABLE candidat CHANGE Competence Competence VARCHAR(250) NOT NULL');
    }
}
