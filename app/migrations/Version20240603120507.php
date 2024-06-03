<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603120507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE set_history DROP CONSTRAINT FK_A01696AC10FB0D18');
        $this->addSql('ALTER TABLE set_history DROP CONSTRAINT FK_A01696ACC69D3FB');
        $this->addSql('ALTER TABLE set_history ADD CONSTRAINT FK_A01696AC10FB0D18 FOREIGN KEY (set_id) REFERENCES set (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE set_history ADD CONSTRAINT FK_A01696ACC69D3FB FOREIGN KEY (usr_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE set_history DROP CONSTRAINT fk_a01696ac10fb0d18');
        $this->addSql('ALTER TABLE set_history DROP CONSTRAINT fk_a01696acc69d3fb');
        $this->addSql('ALTER TABLE set_history ADD CONSTRAINT fk_a01696ac10fb0d18 FOREIGN KEY (set_id) REFERENCES set (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE set_history ADD CONSTRAINT fk_a01696acc69d3fb FOREIGN KEY (usr_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
