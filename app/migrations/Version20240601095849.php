<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601095849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert data into set and word';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO set (author_id, name, image, word_count) VALUES (1, 'Monitors', 'assets/images/monitor.png', 3)");

        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('word1', 'word1_pl')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('word2', 'word2_pl')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('word3', 'word3_pl')");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DELETE FROM set WHERE name IN ('Monitors')");

        $this->addSql("DELETE FROM word WHERE word_en IN ('word1', 'word2', 'word3')");
    }
}
