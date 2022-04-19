<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220419175103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE customer_variable_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE customer_variable (id INT NOT NULL, customer_bp_id INT NOT NULL, variable_id INT NOT NULL, value VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E088C4A219DA1AB5 ON customer_variable (customer_bp_id)');
        $this->addSql('CREATE INDEX IDX_E088C4A2F3037E8E ON customer_variable (variable_id)');
        $this->addSql('ALTER TABLE customer_variable ADD CONSTRAINT FK_E088C4A219DA1AB5 FOREIGN KEY (customer_bp_id) REFERENCES customer_bp (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_variable ADD CONSTRAINT FK_E088C4A2F3037E8E FOREIGN KEY (variable_id) REFERENCES variable (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_bp ADD project_summary TEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE customer_variable_id_seq CASCADE');
        $this->addSql('DROP TABLE customer_variable');
        $this->addSql('ALTER TABLE customer_bp DROP project_summary');
    }
}
