<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220722200233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, description VARCHAR(255) NOT NULL, couleur VARCHAR(15) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_niveaux (categories_id INT NOT NULL, niveaux_id INT NOT NULL, INDEX IDX_7EFDA000A21214B7 (categories_id), INDEX IDX_7EFDA000AAC4B70E (niveaux_id), PRIMARY KEY(categories_id, niveaux_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, designation VARCHAR(100) NOT NULL, capacite INT NOT NULL, effectif INT DEFAULT NULL, slug VARCHAR(128) NOT NULL, INDEX IDX_2ED7EC5B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cycles (id INT AUTO_INCREMENT NOT NULL, enseignement_id INT NOT NULL, designation VARCHAR(100) NOT NULL, INDEX IDX_72B88B24ABEC3B20 (enseignement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseignements (id INT AUTO_INCREMENT NOT NULL, etablissement_id INT NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_89D79280FF631228 (etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissements (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, forme VARCHAR(100) NOT NULL, adresse VARCHAR(255) NOT NULL, num_decision_creation VARCHAR(60) NOT NULL, num_decision_ouverture VARCHAR(60) NOT NULL, date_ouverture DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', num_social VARCHAR(60) DEFAULT NULL, num_fiscal VARCHAR(60) DEFAULT NULL, cpte_bancaire VARCHAR(100) DEFAULT NULL, telephone VARCHAR(30) NOT NULL, telephone_mobile VARCHAR(30) DEFAULT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveaux (id INT AUTO_INCREMENT NOT NULL, cycle_id INT NOT NULL, designation VARCHAR(100) NOT NULL, slug VARCHAR(128) NOT NULL, INDEX IDX_56F771A05EC1162 (cycle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories_niveaux ADD CONSTRAINT FK_7EFDA000A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_niveaux ADD CONSTRAINT FK_7EFDA000AAC4B70E FOREIGN KEY (niveaux_id) REFERENCES niveaux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classes ADD CONSTRAINT FK_2ED7EC5B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveaux (id)');
        $this->addSql('ALTER TABLE cycles ADD CONSTRAINT FK_72B88B24ABEC3B20 FOREIGN KEY (enseignement_id) REFERENCES enseignements (id)');
        $this->addSql('ALTER TABLE enseignements ADD CONSTRAINT FK_89D79280FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissements (id)');
        $this->addSql('ALTER TABLE niveaux ADD CONSTRAINT FK_56F771A05EC1162 FOREIGN KEY (cycle_id) REFERENCES cycles (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories_niveaux DROP FOREIGN KEY FK_7EFDA000A21214B7');
        $this->addSql('ALTER TABLE niveaux DROP FOREIGN KEY FK_56F771A05EC1162');
        $this->addSql('ALTER TABLE cycles DROP FOREIGN KEY FK_72B88B24ABEC3B20');
        $this->addSql('ALTER TABLE enseignements DROP FOREIGN KEY FK_89D79280FF631228');
        $this->addSql('ALTER TABLE categories_niveaux DROP FOREIGN KEY FK_7EFDA000AAC4B70E');
        $this->addSql('ALTER TABLE classes DROP FOREIGN KEY FK_2ED7EC5B3E9C81');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE categories_niveaux');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE cycles');
        $this->addSql('DROP TABLE enseignements');
        $this->addSql('DROP TABLE etablissements');
        $this->addSql('DROP TABLE niveaux');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
