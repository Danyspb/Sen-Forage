<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200918191405 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employes_roles (employes_id INT NOT NULL, roles_id INT NOT NULL, INDEX IDX_5A3D8A4AF971F91F (employes_id), INDEX IDX_5A3D8A4A38C751C4 (roles_id), PRIMARY KEY(employes_id, roles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employes_roles ADD CONSTRAINT FK_5A3D8A4AF971F91F FOREIGN KEY (employes_id) REFERENCES employes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employes_roles ADD CONSTRAINT FK_5A3D8A4A38C751C4 FOREIGN KEY (roles_id) REFERENCES roles (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employes_roles DROP FOREIGN KEY FK_5A3D8A4A38C751C4');
        $this->addSql('DROP TABLE employes_roles');
        $this->addSql('DROP TABLE roles');
    }
}
