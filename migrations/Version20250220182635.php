<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250220182635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Ajout du champ employe_id tout en gardant nom_employe
        $this->addSql('ALTER TABLE vacances ADD employe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vacances ADD CONSTRAINT FK_4800690B1B65292 FOREIGN KEY (employe_id) REFERENCES admin_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4800690B1B65292 ON vacances (employe_id)');
    }
    

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE vacances DROP CONSTRAINT FK_4800690B1B65292');
        $this->addSql('DROP INDEX IDX_4800690B1B65292');
        $this->addSql('ALTER TABLE vacances ADD nom_employe VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE vacances DROP employe_id');
    }
}
