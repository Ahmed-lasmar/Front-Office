<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207150824 extends AbstractMigration
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
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A5752B58D6DA FOREIGN KEY (entretien) REFERENCES entretien (id_entretien)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A5752B58D6DA');
        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY FK_2B58D6DA1323A575');
        $this->addSql('DROP INDEX UNIQ_2B58D6DA1323A575 ON entretien');
        $this->addSql('ALTER TABLE entretien DROP evaluation');
    }
}
