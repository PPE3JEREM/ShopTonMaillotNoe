<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221201201643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maillot DROP FOREIGN KEY FK_A5B7832AFB96A1CA');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2FB96A1CA');
        $this->addSql('DROP TABLE acheter');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP INDEX IDX_A5B7832AFB96A1CA ON maillot');
        $this->addSql('ALTER TABLE maillot DROP acheter_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acheter (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, acheter_id INT DEFAULT NULL, date_panier DATE NOT NULL, moyen_paiement VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_24CC0DF2FB96A1CA (acheter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2FB96A1CA FOREIGN KEY (acheter_id) REFERENCES acheter (id)');
        $this->addSql('ALTER TABLE maillot ADD acheter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE maillot ADD CONSTRAINT FK_A5B7832AFB96A1CA FOREIGN KEY (acheter_id) REFERENCES acheter (id)');
        $this->addSql('CREATE INDEX IDX_A5B7832AFB96A1CA ON maillot (acheter_id)');
    }
}
