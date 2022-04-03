<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220403181704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE bpmodel_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE bpmodel_role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE file_manager_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE image_manager_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE variable_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bpmodel (id INT NOT NULL, variable_id INT DEFAULT NULL, model_file_id INT DEFAULT NULL, created_by INT DEFAULT NULL, name VARCHAR(255) NOT NULL, variable_number INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9BD00AB7F3037E8E ON bpmodel (variable_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9BD00AB7F358109D ON bpmodel (model_file_id)');
        $this->addSql('CREATE INDEX IDX_9BD00AB7DE12AB56 ON bpmodel (created_by)');
        $this->addSql('CREATE TABLE bpmodel_role (id INT NOT NULL, bp_model_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D82AA8F024CAFDA4 ON bpmodel_role (bp_model_id)');
        $this->addSql('CREATE INDEX IDX_D82AA8F0D60322AC ON bpmodel_role (role_id)');
        $this->addSql('CREATE TABLE bpmodel_role_variable (bpmodel_role_id INT NOT NULL, variable_id INT NOT NULL, PRIMARY KEY(bpmodel_role_id, variable_id))');
        $this->addSql('CREATE INDEX IDX_987305DE6EE0490F ON bpmodel_role_variable (bpmodel_role_id)');
        $this->addSql('CREATE INDEX IDX_987305DEF3037E8E ON bpmodel_role_variable (variable_id)');
        $this->addSql('CREATE TABLE file_manager (id INT NOT NULL, file_name VARCHAR(255) DEFAULT NULL, file_size INT DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE image_manager (id INT NOT NULL, file_name VARCHAR(255) DEFAULT NULL, file_size INT DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE role (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE user_role (user_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(user_id, role_id))');
        $this->addSql('CREATE INDEX IDX_2DE8C6A3A76ED395 ON user_role (user_id)');
        $this->addSql('CREATE INDEX IDX_2DE8C6A3D60322AC ON user_role (role_id)');
        $this->addSql('CREATE TABLE variable (id INT NOT NULL, created_by INT DEFAULT NULL, name VARCHAR(255) NOT NULL, definition VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CC4D878DDE12AB56 ON variable (created_by)');
        $this->addSql('ALTER TABLE bpmodel ADD CONSTRAINT FK_9BD00AB7F3037E8E FOREIGN KEY (variable_id) REFERENCES variable (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bpmodel ADD CONSTRAINT FK_9BD00AB7F358109D FOREIGN KEY (model_file_id) REFERENCES file_manager (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bpmodel ADD CONSTRAINT FK_9BD00AB7DE12AB56 FOREIGN KEY (created_by) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bpmodel_role ADD CONSTRAINT FK_D82AA8F024CAFDA4 FOREIGN KEY (bp_model_id) REFERENCES bpmodel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bpmodel_role ADD CONSTRAINT FK_D82AA8F0D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bpmodel_role_variable ADD CONSTRAINT FK_987305DE6EE0490F FOREIGN KEY (bpmodel_role_id) REFERENCES bpmodel_role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bpmodel_role_variable ADD CONSTRAINT FK_987305DEF3037E8E FOREIGN KEY (variable_id) REFERENCES variable (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE variable ADD CONSTRAINT FK_CC4D878DDE12AB56 FOREIGN KEY (created_by) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bpmodel_role DROP CONSTRAINT FK_D82AA8F024CAFDA4');
        $this->addSql('ALTER TABLE bpmodel_role_variable DROP CONSTRAINT FK_987305DE6EE0490F');
        $this->addSql('ALTER TABLE bpmodel DROP CONSTRAINT FK_9BD00AB7F358109D');
        $this->addSql('ALTER TABLE bpmodel_role DROP CONSTRAINT FK_D82AA8F0D60322AC');
        $this->addSql('ALTER TABLE user_role DROP CONSTRAINT FK_2DE8C6A3D60322AC');
        $this->addSql('ALTER TABLE bpmodel DROP CONSTRAINT FK_9BD00AB7DE12AB56');
        $this->addSql('ALTER TABLE user_role DROP CONSTRAINT FK_2DE8C6A3A76ED395');
        $this->addSql('ALTER TABLE variable DROP CONSTRAINT FK_CC4D878DDE12AB56');
        $this->addSql('ALTER TABLE bpmodel DROP CONSTRAINT FK_9BD00AB7F3037E8E');
        $this->addSql('ALTER TABLE bpmodel_role_variable DROP CONSTRAINT FK_987305DEF3037E8E');
        $this->addSql('DROP SEQUENCE bpmodel_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE bpmodel_role_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE file_manager_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE image_manager_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE role_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE variable_id_seq CASCADE');
        $this->addSql('DROP TABLE bpmodel');
        $this->addSql('DROP TABLE bpmodel_role');
        $this->addSql('DROP TABLE bpmodel_role_variable');
        $this->addSql('DROP TABLE file_manager');
        $this->addSql('DROP TABLE image_manager');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('DROP TABLE variable');
    }
}
