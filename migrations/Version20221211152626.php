<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221211152626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE application (id_app INT AUTO_INCREMENT NOT NULL, candidat VARCHAR(50) NOT NULL, offre VARCHAR(50) NOT NULL, cv VARCHAR(50) NOT NULL, etat VARCHAR(50) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id_app)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidat (Id_Can INT AUTO_INCREMENT NOT NULL, URL_CV VARCHAR(255) NOT NULL, D_Post DATE NOT NULL, Competence VARCHAR(255) NOT NULL, PRIMARY KEY(Id_Can)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conge (idCon INT AUTO_INCREMENT NOT NULL, idPer INT NOT NULL, dDepot DATE NOT NULL, typeDemande VARCHAR(255) NOT NULL, etatDemande VARCHAR(255) NOT NULL, dDepart DATE NOT NULL, dRetour DATE NOT NULL, PRIMARY KEY(idCon)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrat (Id_Contrat INT AUTO_INCREMENT NOT NULL, Type_contrat VARCHAR(255) NOT NULL, salaire INT NOT NULL, sate_embauche DATE NOT NULL, PRIMARY KEY(Id_Contrat)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande (Id_dem INT AUTO_INCREMENT NOT NULL, Id_Per INT NOT NULL, Date_depot DATE NOT NULL, Type_demande VARCHAR(255) NOT NULL, Etat_demande VARCHAR(255) NOT NULL, INDEX Id_Per (Id_Per), PRIMARY KEY(Id_dem)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (Id_per INT AUTO_INCREMENT NOT NULL, Date_embauche DATE NOT NULL, Grade VARCHAR(255) NOT NULL, Equipe VARCHAR(255) NOT NULL, PRIMARY KEY(Id_per)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entretien (id_entretien INT AUTO_INCREMENT NOT NULL, evaluation INT DEFAULT NULL, id_candidat INT DEFAULT NULL, firstname_candidat VARCHAR(200) NOT NULL, name_candidat VARCHAR(200) NOT NULL, heure VARCHAR(200) NOT NULL, person_present VARCHAR(200) NOT NULL, date_entretien DATE NOT NULL, UNIQUE INDEX UNIQ_2B58D6DA1323A575 (evaluation), INDEX id_entretien (id_entretien), PRIMARY KEY(id_entretien)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id_evaluation INT AUTO_INCREMENT NOT NULL, entretien INT DEFAULT NULL, id_entretien INT DEFAULT NULL, note INT DEFAULT NULL, avis VARCHAR(30) DEFAULT NULL, UNIQUE INDEX UNIQ_1323A5752B58D6DA (entretien), INDEX id_entretien (id_entretien), PRIMARY KEY(id_evaluation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (idEvent INT AUTO_INCREMENT NOT NULL, idUser INT NOT NULL, type VARCHAR(20) NOT NULL, dateEvent VARCHAR(20) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(idEvent)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_de_paie (ID_FP INT AUTO_INCREMENT NOT NULL, ID_Per INT NOT NULL, Salaire_init INT NOT NULL, ID_Prime INT NOT NULL, Salaire_total INT NOT NULL, Date_paiement DATE NOT NULL, Etat_paiement VARCHAR(255) NOT NULL, PRIMARY KEY(ID_FP)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateur (Id_Formateur INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel INT NOT NULL, codeP INT NOT NULL, ville VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, tarif INT NOT NULL, tva INT NOT NULL, bio VARCHAR(255) NOT NULL, diplome VARCHAR(255) NOT NULL, PRIMARY KEY(Id_Formateur)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (Id_For INT AUTO_INCREMENT NOT NULL, Id_Formateur INT NOT NULL, Date_For DATE NOT NULL, Nom_For VARCHAR(255) NOT NULL, Numbr_Max_Per INT NOT NULL, PRIMARY KEY(Id_For)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formatteur (Id_formatteur INT AUTO_INCREMENT NOT NULL, horaire INT NOT NULL, specialite VARCHAR(255) NOT NULL, membres VARCHAR(255) NOT NULL, PRIMARY KEY(Id_formatteur)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, formation INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C53D045F404021BF (formation), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, offreemploi INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_E01FBE6AA9B2BBFD (offreemploi), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E016BA31DB (delivered_at), INDEX IDX_75EA56E0E3BD61CE (available_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offreemploi (id_offre INT AUTO_INCREMENT NOT NULL, nomOffre VARCHAR(50) NOT NULL, description VARCHAR(50) NOT NULL, skills VARCHAR(50) NOT NULL, picture VARCHAR(50) NOT NULL, PRIMARY KEY(id_offre)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (idEvent INT NOT NULL, idParticipation INT AUTO_INCREMENT NOT NULL, idUser INT NOT NULL, Pmail VARCHAR(30) NOT NULL, PRIMARY KEY(idParticipation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (Id_Per INT AUTO_INCREMENT NOT NULL, Nom VARCHAR(255) NOT NULL, Prenom VARCHAR(255) NOT NULL, E_mail VARCHAR(255) NOT NULL, CIN VARCHAR(255) NOT NULL, URL_Photo VARCHAR(255) NOT NULL, Date_de_naissance DATE NOT NULL, Num_Tel INT NOT NULL, PRIMARY KEY(Id_Per)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE postule (id_Post INT AUTO_INCREMENT NOT NULL, Id_Can INT NOT NULL, Id_Off INT NOT NULL, Date_Post DATE NOT NULL, Etat_Post VARCHAR(255) NOT NULL, INDEX Id_Can (Id_Can), INDEX Id_Off (Id_Off), PRIMARY KEY(id_Post)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prime (ID_Prime INT AUTO_INCREMENT NOT NULL, Type_Prime VARCHAR(255) NOT NULL, Valeur_Prime INT NOT NULL, Date_Prime DATE NOT NULL, PRIMARY KEY(ID_Prime)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate (id INT AUTO_INCREMENT NOT NULL, offreemploi INT DEFAULT NULL, user INT DEFAULT NULL, rating VARCHAR(255) NOT NULL, INDEX IDX_DFEC3F39A9B2BBFD (offreemploi), INDEX IDX_DFEC3F398D93D649 (user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (idUser INT AUTO_INCREMENT NOT NULL, Nom VARCHAR(255) DEFAULT NULL, Prenom VARCHAR(255) DEFAULT NULL, Email VARCHAR(255) DEFAULT NULL, Cin VARCHAR(255) DEFAULT NULL, URL_Photo VARCHAR(255) DEFAULT NULL, Date_de_naissance DATE DEFAULT NULL, Num_Tel VARCHAR(255) DEFAULT NULL, Date_embauche DATE DEFAULT NULL, Grade VARCHAR(255) DEFAULT NULL, Equipe VARCHAR(255) DEFAULT NULL, Role VARCHAR(255) DEFAULT NULL, mdp VARCHAR(255) DEFAULT NULL, reset_token VARCHAR(180) DEFAULT NULL, PRIMARY KEY(idUser)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT FK_2B58D6DA1323A575 FOREIGN KEY (evaluation) REFERENCES evaluation (id_evaluation)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A5752B58D6DA FOREIGN KEY (entretien) REFERENCES entretien (id_entretien)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F404021BF FOREIGN KEY (formation) REFERENCES formation (Id_For)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AA9B2BBFD FOREIGN KEY (offreemploi) REFERENCES offreemploi (id_offre)');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F39A9B2BBFD FOREIGN KEY (offreemploi) REFERENCES offreemploi (id_offre)');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F398D93D649 FOREIGN KEY (user) REFERENCES user (idUser)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY FK_2B58D6DA1323A575');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A5752B58D6DA');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F404021BF');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AA9B2BBFD');
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F39A9B2BBFD');
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F398D93D649');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE conge');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE entretien');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE fiche_de_paie');
        $this->addSql('DROP TABLE formateur');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formatteur');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP TABLE offreemploi');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE postule');
        $this->addSql('DROP TABLE prime');
        $this->addSql('DROP TABLE rate');
        $this->addSql('DROP TABLE user');
    }
}
