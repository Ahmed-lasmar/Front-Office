<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221114091808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE Prenom Prenom VARCHAR(255) DEFAULT NULL, CHANGE Cin Cin VARCHAR(255) DEFAULT NULL, CHANGE URL_Photo URL_Photo VARCHAR(255) DEFAULT NULL, CHANGE Date_de_naissance Date_de_naissance DATE DEFAULT NULL, CHANGE Num_Tel Num_Tel VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE Prenom Prenom VARCHAR(255) NOT NULL, CHANGE Cin Cin VARCHAR(255) NOT NULL, CHANGE URL_Photo URL_Photo VARCHAR(255) NOT NULL, CHANGE Date_de_naissance Date_de_naissance DATE NOT NULL, CHANGE Num_Tel Num_Tel VARCHAR(255) NOT NULL');
    }
}
