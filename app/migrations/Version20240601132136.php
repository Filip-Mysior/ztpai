<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601132136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE set ADD image_id INT NOT NULL');
        $this->addSql('ALTER TABLE set DROP image');
        $this->addSql('ALTER TABLE set ADD CONSTRAINT FK_E61425DC3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E61425DC3DA5256D ON set (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE set DROP CONSTRAINT FK_E61425DC3DA5256D');
        $this->addSql('DROP INDEX UNIQ_E61425DC3DA5256D');
        $this->addSql('ALTER TABLE set ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE set DROP image_id');
    }
}
