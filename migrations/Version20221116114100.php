<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221116114100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acheter (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, sport_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_2449BA15AC78BCF8 (sport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maillot (id INT AUTO_INCREMENT NOT NULL, equipe_id INT NOT NULL, acheter_id INT DEFAULT NULL, type_maillot VARCHAR(255) DEFAULT NULL, saison VARCHAR(255) DEFAULT NULL, image VARCHAR(255) NOT NULL, matiere VARCHAR(255) DEFAULT NULL, taille VARCHAR(255) NOT NULL, prix INT NOT NULL, description VARCHAR(255) DEFAULT NULL, disponibilite VARCHAR(255) NOT NULL, stock INT NOT NULL, INDEX IDX_A5B7832A6D861B89 (equipe_id), INDEX IDX_A5B7832AFB96A1CA (acheter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, acheter_id INT DEFAULT NULL, date_panier DATE NOT NULL, moyen_paiement VARCHAR(255) NOT NULL, INDEX IDX_24CC0DF2FB96A1CA (acheter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE maillot ADD CONSTRAINT FK_A5B7832A6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE maillot ADD CONSTRAINT FK_A5B7832AFB96A1CA FOREIGN KEY (acheter_id) REFERENCES acheter (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2FB96A1CA FOREIGN KEY (acheter_id) REFERENCES acheter (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15AC78BCF8');
        $this->addSql('ALTER TABLE maillot DROP FOREIGN KEY FK_A5B7832A6D861B89');
        $this->addSql('ALTER TABLE maillot DROP FOREIGN KEY FK_A5B7832AFB96A1CA');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2FB96A1CA');
        $this->addSql('DROP TABLE acheter');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE maillot');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE sport');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
