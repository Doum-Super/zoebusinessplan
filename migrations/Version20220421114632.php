<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220421114632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE customer_bp_variable');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE customer_bp_variable (customer_bp_id INT NOT NULL, variable_id INT NOT NULL, PRIMARY KEY(customer_bp_id, variable_id))');
        $this->addSql('CREATE INDEX idx_92b9e6c619da1ab5 ON customer_bp_variable (customer_bp_id)');
        $this->addSql('CREATE INDEX idx_92b9e6c6f3037e8e ON customer_bp_variable (variable_id)');
        $this->addSql('ALTER TABLE customer_bp_variable ADD CONSTRAINT fk_92b9e6c619da1ab5 FOREIGN KEY (customer_bp_id) REFERENCES customer_bp (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_bp_variable ADD CONSTRAINT fk_92b9e6c6f3037e8e FOREIGN KEY (variable_id) REFERENCES variable (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
