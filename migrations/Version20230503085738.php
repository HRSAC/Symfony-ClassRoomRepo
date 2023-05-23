<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230503085738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE absence (id INT AUTO_INCREMENT NOT NULL, peut_id INT DEFAULT NULL, date DATE NOT NULL, justificatif VARCHAR(255) DEFAULT NULL, INDEX IDX_765AE0C96552D5EA (peut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date DATE NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, periode_debut DATE NOT NULL, periode_fin DATE NOT NULL, description VARCHAR(255) NOT NULL, matiere VARCHAR(255) NOT NULL, eleve_max INT NOT NULL, INDEX IDX_FDCA8C9CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naiss_eleve VARCHAR(255) NOT NULL, sexe TINYINT(1) NOT NULL, telephone_eleve VARCHAR(10) NOT NULL, adresse VARCHAR(255) NOT NULL, profession VARCHAR(255) DEFAULT NULL, diplome VARCHAR(255) DEFAULT NULL, matricule VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscrit (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscrit_eleve (inscrit_id INT NOT NULL, eleve_id INT NOT NULL, INDEX IDX_C4EC4E906DCD4FEE (inscrit_id), INDEX IDX_C4EC4E90A6CC7B2 (eleve_id), PRIMARY KEY(inscrit_id, eleve_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscrit_cours (inscrit_id INT NOT NULL, cours_id INT NOT NULL, INDEX IDX_D587C7FB6DCD4FEE (inscrit_id), INDEX IDX_D587C7FB7ECF78B0 (cours_id), PRIMARY KEY(inscrit_id, cours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naiss_user DATE NOT NULL, mail VARCHAR(255) NOT NULL, sexe TINYINT(1) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE absence ADD CONSTRAINT FK_765AE0C96552D5EA FOREIGN KEY (peut_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscrit_eleve ADD CONSTRAINT FK_C4EC4E906DCD4FEE FOREIGN KEY (inscrit_id) REFERENCES inscrit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscrit_eleve ADD CONSTRAINT FK_C4EC4E90A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscrit_cours ADD CONSTRAINT FK_D587C7FB6DCD4FEE FOREIGN KEY (inscrit_id) REFERENCES inscrit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscrit_cours ADD CONSTRAINT FK_D587C7FB7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absence DROP FOREIGN KEY FK_765AE0C96552D5EA');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CA76ED395');
        $this->addSql('ALTER TABLE inscrit_eleve DROP FOREIGN KEY FK_C4EC4E906DCD4FEE');
        $this->addSql('ALTER TABLE inscrit_eleve DROP FOREIGN KEY FK_C4EC4E90A6CC7B2');
        $this->addSql('ALTER TABLE inscrit_cours DROP FOREIGN KEY FK_D587C7FB6DCD4FEE');
        $this->addSql('ALTER TABLE inscrit_cours DROP FOREIGN KEY FK_D587C7FB7ECF78B0');
        $this->addSql('DROP TABLE absence');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE inscrit');
        $this->addSql('DROP TABLE inscrit_eleve');
        $this->addSql('DROP TABLE inscrit_cours');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
