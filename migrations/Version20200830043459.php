<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200830043459 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnes (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, date DATETIME NOT NULL, numero VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_A6C50F9C19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, villages_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone INT NOT NULL, INDEX IDX_C82E74E499527C (villages_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compteurs (id INT AUTO_INCREMENT NOT NULL, abonnes_id INT NOT NULL, numcompteur VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_EDFAEB4BFEDEAEF2 (abonnes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consommation (id INT AUTO_INCREMENT NOT NULL, compteur_id INT NOT NULL, litreconsomme DOUBLE PRECISION NOT NULL, prix DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, INDEX IDX_F993F0A2AA3B9810 (compteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employes (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factures (id INT AUTO_INCREMENT NOT NULL, consommation_id INT NOT NULL, consmensuelle DOUBLE PRECISION NOT NULL, prix DOUBLE PRECISION NOT NULL, datefacture DATETIME NOT NULL, datelimitepaye DATETIME NOT NULL, UNIQUE INDEX UNIQ_647590BC1076F84 (consommation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reglement (id INT AUTO_INCREMENT NOT NULL, facture_id INT NOT NULL, etatpaiement VARCHAR(255) NOT NULL, etatcompteur VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_EBE4C14C7F2DEE08 (facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE village (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, chefvillage VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnes ADD CONSTRAINT FK_A6C50F9C19EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E74E499527C FOREIGN KEY (villages_id) REFERENCES village (id)');
        $this->addSql('ALTER TABLE compteurs ADD CONSTRAINT FK_EDFAEB4BFEDEAEF2 FOREIGN KEY (abonnes_id) REFERENCES abonnes (id)');
        $this->addSql('ALTER TABLE consommation ADD CONSTRAINT FK_F993F0A2AA3B9810 FOREIGN KEY (compteur_id) REFERENCES compteurs (id)');
        $this->addSql('ALTER TABLE factures ADD CONSTRAINT FK_647590BC1076F84 FOREIGN KEY (consommation_id) REFERENCES consommation (id)');
        $this->addSql('ALTER TABLE reglement ADD CONSTRAINT FK_EBE4C14C7F2DEE08 FOREIGN KEY (facture_id) REFERENCES factures (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compteurs DROP FOREIGN KEY FK_EDFAEB4BFEDEAEF2');
        $this->addSql('ALTER TABLE abonnes DROP FOREIGN KEY FK_A6C50F9C19EB6921');
        $this->addSql('ALTER TABLE consommation DROP FOREIGN KEY FK_F993F0A2AA3B9810');
        $this->addSql('ALTER TABLE factures DROP FOREIGN KEY FK_647590BC1076F84');
        $this->addSql('ALTER TABLE reglement DROP FOREIGN KEY FK_EBE4C14C7F2DEE08');
        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E74E499527C');
        $this->addSql('DROP TABLE abonnes');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE compteurs');
        $this->addSql('DROP TABLE consommation');
        $this->addSql('DROP TABLE employes');
        $this->addSql('DROP TABLE factures');
        $this->addSql('DROP TABLE reglement');
        $this->addSql('DROP TABLE village');
    }
}
