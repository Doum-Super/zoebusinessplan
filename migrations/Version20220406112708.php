<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220406112708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE variable ADD b_pmodel_id INT DEFAULT NULL, ADD value VARCHAR(255) DEFAULT NULL, ADD type VARCHAR(255) DEFAULT NULL, CHANGE definition definition VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE variable ADD CONSTRAINT FK_CC4D878DC7D4E88B FOREIGN KEY (b_pmodel_id) REFERENCES bpmodel (id)');
        $this->addSql('CREATE INDEX IDX_CC4D878DC7D4E88B ON variable (b_pmodel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE variable DROP FOREIGN KEY FK_CC4D878DC7D4E88B');
        $this->addSql('DROP INDEX IDX_CC4D878DC7D4E88B ON variable');
        $this->addSql('ALTER TABLE variable DROP b_pmodel_id, DROP value, DROP type, CHANGE definition definition VARCHAR(255) NOT NULL');
    }
}
