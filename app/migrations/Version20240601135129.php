<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601135129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (1, 1)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (1, 2)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (1, 3)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (1, 4)");

        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (2, 5)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (2, 6)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (2, 7)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (2, 8)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (2, 9)");

        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (3, 10)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (3, 11)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (3, 12)");

        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (4, 13)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (4, 14)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (4, 15)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (4, 16)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (4, 17)");

        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (5, 18)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (5, 19)");

        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (6, 20)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (6, 21)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (6, 22)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (6, 23)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (6, 24)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (6, 25)");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql("DELETE FROM set_word WHERE set_id IN (1, 2, 3, 4, 5, 6)");
    }
}
