<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220528180527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_bp ADD working_capital_comment TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer_bp ADD financing_needs_comment TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer_bp ADD revenue_forecast_comment TEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE customer_bp DROP working_capital_comment');
        $this->addSql('ALTER TABLE customer_bp DROP financing_needs_comment');
        $this->addSql('ALTER TABLE customer_bp DROP revenue_forecast_comment');
    }
}
