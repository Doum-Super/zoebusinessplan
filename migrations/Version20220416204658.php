<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220416204658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE customer_bp_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE variable_values_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE customer_bp (id INT NOT NULL, cover_id INT DEFAULT NULL, bp_model_id INT NOT NULL, created_by INT DEFAULT NULL, business_name VARCHAR(255) DEFAULT NULL, project_description TEXT DEFAULT NULL, beneficiary_first_name VARCHAR(255) DEFAULT NULL, beneficiary_last_name VARCHAR(255) DEFAULT NULL, beneficiary_sex VARCHAR(255) DEFAULT NULL, beneficiary_marital_status VARCHAR(255) DEFAULT NULL, beneficiary_phone_number VARCHAR(255) DEFAULT NULL, beneficiary_address VARCHAR(255) DEFAULT NULL, beneficiary_study_level VARCHAR(255) DEFAULT NULL, market_description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6ABBCE45922726E9 ON customer_bp (cover_id)');
        $this->addSql('CREATE INDEX IDX_6ABBCE4524CAFDA4 ON customer_bp (bp_model_id)');
        $this->addSql('CREATE INDEX IDX_6ABBCE45DE12AB56 ON customer_bp (created_by)');
        $this->addSql('CREATE TABLE customer_bp_variable (customer_bp_id INT NOT NULL, variable_id INT NOT NULL, PRIMARY KEY(customer_bp_id, variable_id))');
        $this->addSql('CREATE INDEX IDX_92B9E6C619DA1AB5 ON customer_bp_variable (customer_bp_id)');
        $this->addSql('CREATE INDEX IDX_92B9E6C6F3037E8E ON customer_bp_variable (variable_id)');
        $this->addSql('CREATE TABLE role_variable (role_id INT NOT NULL, variable_id INT NOT NULL, PRIMARY KEY(role_id, variable_id))');
        $this->addSql('CREATE INDEX IDX_E69E61BCD60322AC ON role_variable (role_id)');
        $this->addSql('CREATE INDEX IDX_E69E61BCF3037E8E ON role_variable (variable_id)');
        $this->addSql('CREATE TABLE variable_values (id INT NOT NULL, variable_id INT NOT NULL, created_by INT DEFAULT NULL, value VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B518C971F3037E8E ON variable_values (variable_id)');
        $this->addSql('CREATE INDEX IDX_B518C971DE12AB56 ON variable_values (created_by)');
        $this->addSql('ALTER TABLE customer_bp ADD CONSTRAINT FK_6ABBCE45922726E9 FOREIGN KEY (cover_id) REFERENCES image_manager (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_bp ADD CONSTRAINT FK_6ABBCE4524CAFDA4 FOREIGN KEY (bp_model_id) REFERENCES bpmodel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_bp ADD CONSTRAINT FK_6ABBCE45DE12AB56 FOREIGN KEY (created_by) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_bp_variable ADD CONSTRAINT FK_92B9E6C619DA1AB5 FOREIGN KEY (customer_bp_id) REFERENCES customer_bp (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_bp_variable ADD CONSTRAINT FK_92B9E6C6F3037E8E FOREIGN KEY (variable_id) REFERENCES variable (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role_variable ADD CONSTRAINT FK_E69E61BCD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role_variable ADD CONSTRAINT FK_E69E61BCF3037E8E FOREIGN KEY (variable_id) REFERENCES variable (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE variable_values ADD CONSTRAINT FK_B518C971F3037E8E FOREIGN KEY (variable_id) REFERENCES variable (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE variable_values ADD CONSTRAINT FK_B518C971DE12AB56 FOREIGN KEY (created_by) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role ADD created_by INT DEFAULT NULL');
        $this->addSql('ALTER TABLE role ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE role ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6ADE12AB56 FOREIGN KEY (created_by) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_57698A6ADE12AB56 ON role (created_by)');
        $this->addSql('ALTER TABLE variable ADD b_pmodel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE variable ADD value VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE variable ADD type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE variable ALTER definition DROP NOT NULL');
        $this->addSql('ALTER TABLE variable ADD CONSTRAINT FK_CC4D878DC7D4E88B FOREIGN KEY (b_pmodel_id) REFERENCES bpmodel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CC4D878DC7D4E88B ON variable (b_pmodel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE customer_bp_variable DROP CONSTRAINT FK_92B9E6C619DA1AB5');
        $this->addSql('DROP SEQUENCE customer_bp_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE variable_values_id_seq CASCADE');
        $this->addSql('DROP TABLE customer_bp');
        $this->addSql('DROP TABLE customer_bp_variable');
        $this->addSql('DROP TABLE role_variable');
        $this->addSql('DROP TABLE variable_values');
        $this->addSql('ALTER TABLE role DROP CONSTRAINT FK_57698A6ADE12AB56');
        $this->addSql('DROP INDEX IDX_57698A6ADE12AB56');
        $this->addSql('ALTER TABLE role DROP created_by');
        $this->addSql('ALTER TABLE role DROP created_at');
        $this->addSql('ALTER TABLE role DROP updated_at');
        $this->addSql('ALTER TABLE variable DROP CONSTRAINT FK_CC4D878DC7D4E88B');
        $this->addSql('DROP INDEX IDX_CC4D878DC7D4E88B');
        $this->addSql('ALTER TABLE variable DROP b_pmodel_id');
        $this->addSql('ALTER TABLE variable DROP value');
        $this->addSql('ALTER TABLE variable DROP type');
        $this->addSql('ALTER TABLE variable ALTER definition SET NOT NULL');
    }
}
