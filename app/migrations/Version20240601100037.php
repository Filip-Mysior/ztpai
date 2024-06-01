<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601100037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Integrate words into sets';   
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (1, 1)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (1, 2)");
        $this->addSql("INSERT INTO set_word (set_id, word_id) VALUES (1, 3)");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DELETE FROM set_word WHERE set_id IN (1)");
    }
}
