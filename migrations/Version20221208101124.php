<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221208101124 extends AbstractMigration
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
        $this->addSql('ALTER TABLE evenement CHANGE adresse adresse VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offreemploi CHANGE description description VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE Nom Nom VARCHAR(255) DEFAULT NULL, CHANGE Cin Cin VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F404021BF');
        $this->addSql('DROP TABLE image');
        $this->addSql('ALTER TABLE offreemploi CHANGE description description VARCHAR(15000) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE Nom Nom VARCHAR(255) NOT NULL, CHANGE Cin Cin VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE adresse adresse VARCHAR(20) NOT NULL');
    }
}
