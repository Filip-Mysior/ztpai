<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240414125552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE set_word (set_id INT NOT NULL, word_id INT NOT NULL, PRIMARY KEY(set_id, word_id))');
        $this->addSql('CREATE INDEX IDX_5636979810FB0D18 ON set_word (set_id)');
        $this->addSql('CREATE INDEX IDX_56369798E357438D ON set_word (word_id)');
        $this->addSql('ALTER TABLE set_word ADD CONSTRAINT FK_5636979810FB0D18 FOREIGN KEY (set_id) REFERENCES set (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE set_word ADD CONSTRAINT FK_56369798E357438D FOREIGN KEY (word_id) REFERENCES word (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE set ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE set ADD CONSTRAINT FK_E61425DCF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E61425DCF675F31B ON set (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE set_word DROP CONSTRAINT FK_5636979810FB0D18');
        $this->addSql('ALTER TABLE set_word DROP CONSTRAINT FK_56369798E357438D');
        $this->addSql('DROP TABLE set_word');
        $this->addSql('ALTER TABLE set DROP CONSTRAINT FK_E61425DCF675F31B');
        $this->addSql('DROP INDEX IDX_E61425DCF675F31B');
        $this->addSql('ALTER TABLE set DROP author_id');
    }
}
