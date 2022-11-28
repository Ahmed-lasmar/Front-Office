<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221127153846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entretien ADD evaluation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT FK_2B58D6DA456C5646 FOREIGN KEY (evaluation_id) REFERENCES evaluation (id_evaluation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2B58D6DA456C5646 ON entretien (evaluation_id)');
        $this->addSql('ALTER TABLE evaluation ADD entretien_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575548DCEA2 FOREIGN KEY (entretien_id) REFERENCES entretien (id_entretien)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1323A575548DCEA2 ON evaluation (entretien_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575548DCEA2');
        $this->addSql('DROP INDEX UNIQ_1323A575548DCEA2 ON evaluation');
        $this->addSql('ALTER TABLE evaluation DROP entretien_id');
        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY FK_2B58D6DA456C5646');
        $this->addSql('DROP INDEX UNIQ_2B58D6DA456C5646 ON entretien');
        $this->addSql('ALTER TABLE entretien DROP evaluation_id');
    }
}
