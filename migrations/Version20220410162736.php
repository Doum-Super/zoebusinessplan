<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220410162736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer_bp (id INT AUTO_INCREMENT NOT NULL, cover_id INT DEFAULT NULL, bp_model_id INT NOT NULL, created_by INT DEFAULT NULL, business_name VARCHAR(255) DEFAULT NULL, project_description LONGTEXT DEFAULT NULL, beneficiary_first_name VARCHAR(255) DEFAULT NULL, beneficiary_last_name VARCHAR(255) DEFAULT NULL, beneficiary_sex VARCHAR(255) DEFAULT NULL, beneficiary_marital_status VARCHAR(255) DEFAULT NULL, beneficiary_phone_number VARCHAR(255) DEFAULT NULL, beneficiary_address VARCHAR(255) DEFAULT NULL, beneficiary_study_level VARCHAR(255) DEFAULT NULL, market_description LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_6ABBCE45922726E9 (cover_id), INDEX IDX_6ABBCE4524CAFDA4 (bp_model_id), INDEX IDX_6ABBCE45DE12AB56 (created_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_bp_variable (customer_bp_id INT NOT NULL, variable_id INT NOT NULL, INDEX IDX_92B9E6C619DA1AB5 (customer_bp_id), INDEX IDX_92B9E6C6F3037E8E (variable_id), PRIMARY KEY(customer_bp_id, variable_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_variable (role_id INT NOT NULL, variable_id INT NOT NULL, INDEX IDX_E69E61BCD60322AC (role_id), INDEX IDX_E69E61BCF3037E8E (variable_id), PRIMARY KEY(role_id, variable_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customer_bp ADD CONSTRAINT FK_6ABBCE45922726E9 FOREIGN KEY (cover_id) REFERENCES image_manager (id)');
        $this->addSql('ALTER TABLE customer_bp ADD CONSTRAINT FK_6ABBCE4524CAFDA4 FOREIGN KEY (bp_model_id) REFERENCES bpmodel (id)');
        $this->addSql('ALTER TABLE customer_bp ADD CONSTRAINT FK_6ABBCE45DE12AB56 FOREIGN KEY (created_by) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_bp_variable ADD CONSTRAINT FK_92B9E6C619DA1AB5 FOREIGN KEY (customer_bp_id) REFERENCES customer_bp (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_bp_variable ADD CONSTRAINT FK_92B9E6C6F3037E8E FOREIGN KEY (variable_id) REFERENCES variable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_variable ADD CONSTRAINT FK_E69E61BCD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_variable ADD CONSTRAINT FK_E69E61BCF3037E8E FOREIGN KEY (variable_id) REFERENCES variable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role ADD created_by INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6ADE12AB56 FOREIGN KEY (created_by) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_57698A6ADE12AB56 ON role (created_by)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_bp_variable DROP FOREIGN KEY FK_92B9E6C619DA1AB5');
        $this->addSql('DROP TABLE customer_bp');
        $this->addSql('DROP TABLE customer_bp_variable');
        $this->addSql('DROP TABLE role_variable');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6ADE12AB56');
        $this->addSql('DROP INDEX IDX_57698A6ADE12AB56 ON role');
        $this->addSql('ALTER TABLE role DROP created_by, DROP created_at, DROP updated_at');
    }
}
