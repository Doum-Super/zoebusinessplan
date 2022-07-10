<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703050756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enterprises DROP FOREIGN KEY enterprises_activitysector_id_foreign');
        $this->addSql('ALTER TABLE typebps DROP FOREIGN KEY typebps_activitysector_id_foreign');
        $this->addSql('ALTER TABLE activities DROP FOREIGN KEY activities_businessplan_id_foreign');
        $this->addSql('ALTER TABLE bpvars DROP FOREIGN KEY bpvars_businessplan_id_foreign');
        $this->addSql('ALTER TABLE businessplans DROP FOREIGN KEY businessplans_enterprise_id_foreign');
        $this->addSql('ALTER TABLE enterprises DROP FOREIGN KEY enterprises_legalform_id_foreign');
        $this->addSql('ALTER TABLE modeltotals DROP FOREIGN KEY modeltotals_modelvarfin_id_foreign');
        $this->addSql('ALTER TABLE modeltotals DROP FOREIGN KEY modeltotals_modelvar_id_foreign');
        $this->addSql('ALTER TABLE quantityfactors DROP FOREIGN KEY quantityfactors_modelvar_id_foreign');
        $this->addSql('ALTER TABLE model_has_permissions DROP FOREIGN KEY model_has_permissions_permission_id_foreign');
        $this->addSql('ALTER TABLE role_has_permissions DROP FOREIGN KEY role_has_permissions_permission_id_foreign');
        $this->addSql('ALTER TABLE modelvars DROP FOREIGN KEY modelvars_product_id_foreign');
        $this->addSql('ALTER TABLE model_has_roles DROP FOREIGN KEY model_has_roles_role_id_foreign');
        $this->addSql('ALTER TABLE role_has_permissions DROP FOREIGN KEY role_has_permissions_role_id_foreign');
        $this->addSql('ALTER TABLE bpvars DROP FOREIGN KEY bpvars_sectionbp_id_foreign');
        $this->addSql('ALTER TABLE modeltotals DROP FOREIGN KEY modeltotals_sectionbp_id_foreign');
        $this->addSql('ALTER TABLE modelvarfins DROP FOREIGN KEY modelvarfins_sectionbp_id_foreign');
        $this->addSql('ALTER TABLE modelvars DROP FOREIGN KEY modelvars_sectionbp_id_foreign');
        $this->addSql('ALTER TABLE typevars DROP FOREIGN KEY typevars_sectionbp_id_foreign');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY users_studylevel_id_foreign');
        $this->addSql('ALTER TABLE modeltotals DROP FOREIGN KEY modeltotals_typebp_id_foreign');
        $this->addSql('ALTER TABLE modelvarfins DROP FOREIGN KEY modelvarfins_typebp_id_foreign');
        $this->addSql('ALTER TABLE modelvars DROP FOREIGN KEY modelvars_typebp_id_foreign');
        $this->addSql('ALTER TABLE modeltotals DROP FOREIGN KEY modeltotals_typefactor_id_foreign');
        $this->addSql('ALTER TABLE quantityfactors DROP FOREIGN KEY quantityfactors_typefactor_id_foreign');
        $this->addSql('ALTER TABLE modelvarfins DROP FOREIGN KEY modelvarfins_typevar_id_foreign');
        $this->addSql('ALTER TABLE modelvars DROP FOREIGN KEY modelvars_typevar_id_foreign');
        $this->addSql('ALTER TABLE enterprises DROP FOREIGN KEY enterprises_user_id_foreign');
        $this->addSql('CREATE TABLE bpmodel (id INT AUTO_INCREMENT NOT NULL, variable_id INT DEFAULT NULL, model_file_id INT DEFAULT NULL, created_by INT DEFAULT NULL, name VARCHAR(255) NOT NULL, variable_number INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_9BD00AB7F3037E8E (variable_id), UNIQUE INDEX UNIQ_9BD00AB7F358109D (model_file_id), INDEX IDX_9BD00AB7DE12AB56 (created_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bpmodel_role (id INT AUTO_INCREMENT NOT NULL, bp_model_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_D82AA8F024CAFDA4 (bp_model_id), INDEX IDX_D82AA8F0D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bpmodel_role_variable (bpmodel_role_id INT NOT NULL, variable_id INT NOT NULL, INDEX IDX_987305DE6EE0490F (bpmodel_role_id), INDEX IDX_987305DEF3037E8E (variable_id), PRIMARY KEY(bpmodel_role_id, variable_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_bp (id INT AUTO_INCREMENT NOT NULL, cover_id INT DEFAULT NULL, bp_model_id INT NOT NULL, created_by INT DEFAULT NULL, business_name VARCHAR(255) DEFAULT NULL, project_description LONGTEXT DEFAULT NULL, beneficiary_first_name VARCHAR(255) DEFAULT NULL, beneficiary_last_name VARCHAR(255) DEFAULT NULL, beneficiary_sex VARCHAR(255) DEFAULT NULL, beneficiary_marital_status VARCHAR(255) DEFAULT NULL, beneficiary_phone_number VARCHAR(255) DEFAULT NULL, beneficiary_address VARCHAR(255) DEFAULT NULL, beneficiary_study_level VARCHAR(255) DEFAULT NULL, market_description LONGTEXT DEFAULT NULL, project_summary LONGTEXT DEFAULT NULL, customer_date_of_birth DATE DEFAULT NULL, customer_place_of_birth VARCHAR(255) DEFAULT NULL, human_resource LONGTEXT DEFAULT NULL, realization_program LONGTEXT DEFAULT NULL, material_resource LONGTEXT DEFAULT NULL, working_capital_comment LONGTEXT DEFAULT NULL, financing_needs_comment LONGTEXT DEFAULT NULL, revenue_forecast_comment LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_6ABBCE45922726E9 (cover_id), INDEX IDX_6ABBCE4524CAFDA4 (bp_model_id), INDEX IDX_6ABBCE45DE12AB56 (created_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_variable (id INT AUTO_INCREMENT NOT NULL, customer_bp_id INT NOT NULL, variable_id INT NOT NULL, value VARCHAR(255) DEFAULT NULL, INDEX IDX_E088C4A219DA1AB5 (customer_bp_id), INDEX IDX_E088C4A2F3037E8E (variable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file_manager (id INT AUTO_INCREMENT NOT NULL, file_name VARCHAR(255) DEFAULT NULL, file_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_manager (id INT AUTO_INCREMENT NOT NULL, file_name VARCHAR(255) DEFAULT NULL, file_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, created_by INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, code VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_57698A6ADE12AB56 (created_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_variable (role_id INT NOT NULL, variable_id INT NOT NULL, INDEX IDX_E69E61BCD60322AC (role_id), INDEX IDX_E69E61BCF3037E8E (variable_id), PRIMARY KEY(role_id, variable_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_role (user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_2DE8C6A3A76ED395 (user_id), INDEX IDX_2DE8C6A3D60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE variable (id INT AUTO_INCREMENT NOT NULL, b_pmodel_id INT DEFAULT NULL, created_by INT DEFAULT NULL, name VARCHAR(255) NOT NULL, definition VARCHAR(255) DEFAULT NULL, value VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_CC4D878DC7D4E88B (b_pmodel_id), INDEX IDX_CC4D878DDE12AB56 (created_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE variable_values (id INT AUTO_INCREMENT NOT NULL, variable_id INT NOT NULL, created_by INT DEFAULT NULL, value VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_B518C971F3037E8E (variable_id), INDEX IDX_B518C971DE12AB56 (created_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bpmodel ADD CONSTRAINT FK_9BD00AB7F3037E8E FOREIGN KEY (variable_id) REFERENCES variable (id)');
        $this->addSql('ALTER TABLE bpmodel ADD CONSTRAINT FK_9BD00AB7F358109D FOREIGN KEY (model_file_id) REFERENCES file_manager (id)');
        $this->addSql('ALTER TABLE bpmodel ADD CONSTRAINT FK_9BD00AB7DE12AB56 FOREIGN KEY (created_by) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bpmodel_role ADD CONSTRAINT FK_D82AA8F024CAFDA4 FOREIGN KEY (bp_model_id) REFERENCES bpmodel (id)');
        $this->addSql('ALTER TABLE bpmodel_role ADD CONSTRAINT FK_D82AA8F0D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE bpmodel_role_variable ADD CONSTRAINT FK_987305DE6EE0490F FOREIGN KEY (bpmodel_role_id) REFERENCES bpmodel_role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bpmodel_role_variable ADD CONSTRAINT FK_987305DEF3037E8E FOREIGN KEY (variable_id) REFERENCES variable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_bp ADD CONSTRAINT FK_6ABBCE45922726E9 FOREIGN KEY (cover_id) REFERENCES image_manager (id)');
        $this->addSql('ALTER TABLE customer_bp ADD CONSTRAINT FK_6ABBCE4524CAFDA4 FOREIGN KEY (bp_model_id) REFERENCES bpmodel (id)');
        $this->addSql('ALTER TABLE customer_bp ADD CONSTRAINT FK_6ABBCE45DE12AB56 FOREIGN KEY (created_by) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_variable ADD CONSTRAINT FK_E088C4A219DA1AB5 FOREIGN KEY (customer_bp_id) REFERENCES customer_bp (id)');
        $this->addSql('ALTER TABLE customer_variable ADD CONSTRAINT FK_E088C4A2F3037E8E FOREIGN KEY (variable_id) REFERENCES variable (id)');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6ADE12AB56 FOREIGN KEY (created_by) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_variable ADD CONSTRAINT FK_E69E61BCD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_variable ADD CONSTRAINT FK_E69E61BCF3037E8E FOREIGN KEY (variable_id) REFERENCES variable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE variable ADD CONSTRAINT FK_CC4D878DC7D4E88B FOREIGN KEY (b_pmodel_id) REFERENCES bpmodel (id)');
        $this->addSql('ALTER TABLE variable ADD CONSTRAINT FK_CC4D878DDE12AB56 FOREIGN KEY (created_by) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE variable_values ADD CONSTRAINT FK_B518C971F3037E8E FOREIGN KEY (variable_id) REFERENCES variable (id)');
        $this->addSql('ALTER TABLE variable_values ADD CONSTRAINT FK_B518C971DE12AB56 FOREIGN KEY (created_by) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE activities');
        $this->addSql('DROP TABLE activitysectors');
        $this->addSql('DROP TABLE bpvars');
        $this->addSql('DROP TABLE businessplans');
        $this->addSql('DROP TABLE enterprises');
        $this->addSql('DROP TABLE failed_jobs');
        $this->addSql('DROP TABLE legalforms');
        $this->addSql('DROP TABLE migrations');
        $this->addSql('DROP TABLE model_has_permissions');
        $this->addSql('DROP TABLE model_has_roles');
        $this->addSql('DROP TABLE modeltotals');
        $this->addSql('DROP TABLE modelvarfins');
        $this->addSql('DROP TABLE modelvars');
        $this->addSql('DROP TABLE password_resets');
        $this->addSql('DROP TABLE permissions');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE quantityfactors');
        $this->addSql('DROP TABLE role_has_permissions');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE sectionbps');
        $this->addSql('DROP TABLE sectionsmodels');
        $this->addSql('DROP TABLE studylevels');
        $this->addSql('DROP TABLE typebps');
        $this->addSql('DROP TABLE typefactors');
        $this->addSql('DROP TABLE typevars');
        $this->addSql('DROP TABLE users');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bpmodel_role DROP FOREIGN KEY FK_D82AA8F024CAFDA4');
        $this->addSql('ALTER TABLE customer_bp DROP FOREIGN KEY FK_6ABBCE4524CAFDA4');
        $this->addSql('ALTER TABLE variable DROP FOREIGN KEY FK_CC4D878DC7D4E88B');
        $this->addSql('ALTER TABLE bpmodel_role_variable DROP FOREIGN KEY FK_987305DE6EE0490F');
        $this->addSql('ALTER TABLE customer_variable DROP FOREIGN KEY FK_E088C4A219DA1AB5');
        $this->addSql('ALTER TABLE bpmodel DROP FOREIGN KEY FK_9BD00AB7F358109D');
        $this->addSql('ALTER TABLE customer_bp DROP FOREIGN KEY FK_6ABBCE45922726E9');
        $this->addSql('ALTER TABLE bpmodel_role DROP FOREIGN KEY FK_D82AA8F0D60322AC');
        $this->addSql('ALTER TABLE role_variable DROP FOREIGN KEY FK_E69E61BCD60322AC');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3D60322AC');
        $this->addSql('ALTER TABLE bpmodel DROP FOREIGN KEY FK_9BD00AB7DE12AB56');
        $this->addSql('ALTER TABLE customer_bp DROP FOREIGN KEY FK_6ABBCE45DE12AB56');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6ADE12AB56');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3A76ED395');
        $this->addSql('ALTER TABLE variable DROP FOREIGN KEY FK_CC4D878DDE12AB56');
        $this->addSql('ALTER TABLE variable_values DROP FOREIGN KEY FK_B518C971DE12AB56');
        $this->addSql('ALTER TABLE bpmodel DROP FOREIGN KEY FK_9BD00AB7F3037E8E');
        $this->addSql('ALTER TABLE bpmodel_role_variable DROP FOREIGN KEY FK_987305DEF3037E8E');
        $this->addSql('ALTER TABLE customer_variable DROP FOREIGN KEY FK_E088C4A2F3037E8E');
        $this->addSql('ALTER TABLE role_variable DROP FOREIGN KEY FK_E69E61BCF3037E8E');
        $this->addSql('ALTER TABLE variable_values DROP FOREIGN KEY FK_B518C971F3037E8E');
        $this->addSql('CREATE TABLE activities (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, businessplan_id BIGINT UNSIGNED NOT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, start_date DATE NOT NULL, end_date DATE NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX activities_businessplan_id_foreign (businessplan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE activitysectors (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, description TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE bpvars (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, sectionbp_id INT UNSIGNED DEFAULT NULL, businessplan_id BIGINT UNSIGNED NOT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, quantity INT DEFAULT 0 NOT NULL, amount INT NOT NULL, priority VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX bpvars_businessplan_id_foreign (businessplan_id), INDEX bpvars_sectionbp_id_foreign (sectionbp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE businessplans (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, enterprise_id BIGINT UNSIGNED DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, summary VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, description TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, description_market TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, date_bp DATE DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX businessplans_enterprise_id_foreign (enterprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE enterprises (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, legalform_id INT UNSIGNED DEFAULT NULL, activitysector_id INT UNSIGNED DEFAULT NULL, user_id BIGINT UNSIGNED NOT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, logo VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, contact VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, email VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, nbr_employee INT NOT NULL, ca_achieved INT NOT NULL, legal_form VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, rccm VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX enterprises_activitysector_id_foreign (activitysector_id), INDEX enterprises_user_id_foreign (user_id), INDEX enterprises_legalform_id_foreign (legalform_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE failed_jobs (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, uuid VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, connection TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, queue TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, payload LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, exception LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, failed_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX failed_jobs_uuid_unique (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE legalforms (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE migrations (id INT UNSIGNED AUTO_INCREMENT NOT NULL, migration VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, batch INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE model_has_permissions (permission_id BIGINT UNSIGNED NOT NULL, model_type VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, model_id BIGINT UNSIGNED NOT NULL, INDEX model_has_permissions_model_id_model_type_index (model_id, model_type), INDEX IDX_6B22422AFED90CCA (permission_id), PRIMARY KEY(permission_id, model_id, model_type)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE model_has_roles (role_id BIGINT UNSIGNED NOT NULL, model_type VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, model_id BIGINT UNSIGNED NOT NULL, INDEX model_has_roles_model_id_model_type_index (model_id, model_type), INDEX IDX_747E57EAD60322AC (role_id), PRIMARY KEY(role_id, model_id, model_type)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE modeltotals (id INT UNSIGNED AUTO_INCREMENT NOT NULL, modelvar_id INT UNSIGNED DEFAULT NULL, modelvarfin_id INT UNSIGNED DEFAULT NULL, typefactor_id INT UNSIGNED DEFAULT NULL, sectionbp_id INT UNSIGNED NOT NULL, typebp_id INT UNSIGNED NOT NULL, mvalue DOUBLE PRECISION NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX modeltotals_modelvarfin_id_foreign (modelvarfin_id), INDEX modeltotals_typebp_id_foreign (typebp_id), INDEX modeltotals_modelvar_id_foreign (modelvar_id), INDEX modeltotals_sectionbp_id_foreign (sectionbp_id), INDEX modeltotals_typefactor_id_foreign (typefactor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE modelvarfins (id INT UNSIGNED AUTO_INCREMENT NOT NULL, typebp_id INT UNSIGNED NOT NULL, typevar_id INT UNSIGNED NOT NULL, sectionbp_id INT UNSIGNED NOT NULL, interest_rate DOUBLE PRECISION NOT NULL, mvalue INT NOT NULL, tob DOUBLE PRECISION NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX modelvarfins_typevar_id_foreign (typevar_id), INDEX modelvarfins_typebp_id_foreign (typebp_id), INDEX modelvarfins_sectionbp_id_foreign (sectionbp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE modelvars (id INT UNSIGNED AUTO_INCREMENT NOT NULL, product_id INT UNSIGNED DEFAULT NULL, typebp_id INT UNSIGNED NOT NULL, typevar_id INT UNSIGNED DEFAULT NULL, sectionbp_id INT UNSIGNED NOT NULL, name VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, quantity INT DEFAULT 0 NOT NULL, amount DOUBLE PRECISION NOT NULL, category VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, bfr_factor DOUBLE PRECISION DEFAULT NULL, loantype_id INT UNSIGNED DEFAULT NULL, modelvarparent_id INT UNSIGNED DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX modelvars_sectionbp_id_foreign (sectionbp_id), INDEX modelvars_product_id_foreign (product_id), INDEX modelvars_typebp_id_foreign (typebp_id), INDEX modelvars_typevar_id_foreign (typevar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE password_resets (email VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, token VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, created_at DATETIME DEFAULT NULL, INDEX password_resets_email_index (email)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE permissions (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, label VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, name VARCHAR(125) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, guard_name VARCHAR(125) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX permissions_name_guard_name_unique (name, guard_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE products (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE quantityfactors (id INT UNSIGNED AUTO_INCREMENT NOT NULL, typefactor_id INT UNSIGNED NOT NULL, modelvar_id INT UNSIGNED NOT NULL, qvalue DOUBLE PRECISION NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX quantityfactors_modelvar_id_foreign (modelvar_id), INDEX quantityfactors_typefactor_id_foreign (typefactor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE role_has_permissions (permission_id BIGINT UNSIGNED NOT NULL, role_id BIGINT UNSIGNED NOT NULL, INDEX role_has_permissions_role_id_foreign (role_id), INDEX IDX_8BDE50C2FED90CCA (permission_id), PRIMARY KEY(permission_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE roles (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, label VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, name VARCHAR(125) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, guard_name VARCHAR(125) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX roles_name_guard_name_unique (name, guard_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sectionbps (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, description TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, slug VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, code VARCHAR(3) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sectionsmodels (id INT AUTO_INCREMENT NOT NULL, section_id INT NOT NULL, sectionmodel LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE studylevels (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE typebps (id INT UNSIGNED AUTO_INCREMENT NOT NULL, activitysector_id INT UNSIGNED DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, picture VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, summary VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, description TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX typebps_activitysector_id_foreign (activitysector_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE typefactors (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, code VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, position TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE typevars (id INT UNSIGNED AUTO_INCREMENT NOT NULL, sectionbp_id INT UNSIGNED NOT NULL, name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, code VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, code_var VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, category VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, typevarparent_id INT UNSIGNED DEFAULT NULL, type_var_charge VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX typevars_sectionbp_id_foreign (sectionbp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE users (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, studylevel_id INT UNSIGNED DEFAULT NULL, lastname VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, firstname VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, prefix_call VARCHAR(10) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, cellphone VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, email VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, picture VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, profession VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, email_verified_at DATETIME DEFAULT NULL, password VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, remember_token VARCHAR(100) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, facebook_id VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, UNIQUE INDEX users_cellphone_unique (cellphone), UNIQUE INDEX users_email_unique (email), INDEX users_studylevel_id_foreign (studylevel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE activities ADD CONSTRAINT activities_businessplan_id_foreign FOREIGN KEY (businessplan_id) REFERENCES businessplans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bpvars ADD CONSTRAINT bpvars_businessplan_id_foreign FOREIGN KEY (businessplan_id) REFERENCES businessplans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bpvars ADD CONSTRAINT bpvars_sectionbp_id_foreign FOREIGN KEY (sectionbp_id) REFERENCES sectionbps (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE businessplans ADD CONSTRAINT businessplans_enterprise_id_foreign FOREIGN KEY (enterprise_id) REFERENCES enterprises (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enterprises ADD CONSTRAINT enterprises_activitysector_id_foreign FOREIGN KEY (activitysector_id) REFERENCES activitysectors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enterprises ADD CONSTRAINT enterprises_user_id_foreign FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enterprises ADD CONSTRAINT enterprises_legalform_id_foreign FOREIGN KEY (legalform_id) REFERENCES legalforms (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_has_permissions ADD CONSTRAINT model_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES permissions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_has_roles ADD CONSTRAINT model_has_roles_role_id_foreign FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modeltotals ADD CONSTRAINT modeltotals_modelvar_id_foreign FOREIGN KEY (modelvar_id) REFERENCES modelvars (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modeltotals ADD CONSTRAINT modeltotals_sectionbp_id_foreign FOREIGN KEY (sectionbp_id) REFERENCES sectionbps (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modeltotals ADD CONSTRAINT modeltotals_typefactor_id_foreign FOREIGN KEY (typefactor_id) REFERENCES typefactors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modeltotals ADD CONSTRAINT modeltotals_modelvarfin_id_foreign FOREIGN KEY (modelvarfin_id) REFERENCES modelvarfins (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modeltotals ADD CONSTRAINT modeltotals_typebp_id_foreign FOREIGN KEY (typebp_id) REFERENCES typebps (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modelvarfins ADD CONSTRAINT modelvarfins_sectionbp_id_foreign FOREIGN KEY (sectionbp_id) REFERENCES sectionbps (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modelvarfins ADD CONSTRAINT modelvarfins_typevar_id_foreign FOREIGN KEY (typevar_id) REFERENCES typevars (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modelvarfins ADD CONSTRAINT modelvarfins_typebp_id_foreign FOREIGN KEY (typebp_id) REFERENCES typebps (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modelvars ADD CONSTRAINT modelvars_product_id_foreign FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modelvars ADD CONSTRAINT modelvars_typebp_id_foreign FOREIGN KEY (typebp_id) REFERENCES typebps (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modelvars ADD CONSTRAINT modelvars_sectionbp_id_foreign FOREIGN KEY (sectionbp_id) REFERENCES sectionbps (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modelvars ADD CONSTRAINT modelvars_typevar_id_foreign FOREIGN KEY (typevar_id) REFERENCES typevars (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quantityfactors ADD CONSTRAINT quantityfactors_modelvar_id_foreign FOREIGN KEY (modelvar_id) REFERENCES modelvars (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quantityfactors ADD CONSTRAINT quantityfactors_typefactor_id_foreign FOREIGN KEY (typefactor_id) REFERENCES typefactors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_has_permissions ADD CONSTRAINT role_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES permissions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_has_permissions ADD CONSTRAINT role_has_permissions_role_id_foreign FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE typebps ADD CONSTRAINT typebps_activitysector_id_foreign FOREIGN KEY (activitysector_id) REFERENCES activitysectors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE typevars ADD CONSTRAINT typevars_sectionbp_id_foreign FOREIGN KEY (sectionbp_id) REFERENCES sectionbps (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT users_studylevel_id_foreign FOREIGN KEY (studylevel_id) REFERENCES studylevels (id)');
        $this->addSql('DROP TABLE bpmodel');
        $this->addSql('DROP TABLE bpmodel_role');
        $this->addSql('DROP TABLE bpmodel_role_variable');
        $this->addSql('DROP TABLE customer_bp');
        $this->addSql('DROP TABLE customer_variable');
        $this->addSql('DROP TABLE file_manager');
        $this->addSql('DROP TABLE image_manager');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_variable');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('DROP TABLE variable');
        $this->addSql('DROP TABLE variable_values');
    }
}
