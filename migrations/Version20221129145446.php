<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221129145446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rate (id INT AUTO_INCREMENT NOT NULL, rating VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation DROP Image');
        $this->addSql('ALTER TABLE offreemploi ADD rating_id INT DEFAULT NULL, CHANGE description description VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE offreemploi ADD CONSTRAINT FK_A9B2BBFDA32EFC6 FOREIGN KEY (rating_id) REFERENCES rate (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A9B2BBFDA32EFC6 ON offreemploi (rating_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offreemploi DROP FOREIGN KEY FK_A9B2BBFDA32EFC6');
        $this->addSql('DROP TABLE rate');
        $this->addSql('DROP INDEX UNIQ_A9B2BBFDA32EFC6 ON offreemploi');
        $this->addSql('ALTER TABLE offreemploi DROP rating_id, CHANGE description description VARCHAR(500) NOT NULL');
        $this->addSql('ALTER TABLE formation ADD Image VARCHAR(255) NOT NULL');
    }
}
