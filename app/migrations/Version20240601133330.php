<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601133330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO set (author_id, name, image_id, word_count) VALUES (1, 'Processors', 1, 4)");
        $this->addSql("INSERT INTO set (author_id, name, image_id, word_count) VALUES (1, 'Storage Devices', 2, 5)");
        $this->addSql("INSERT INTO set (author_id, name, image_id, word_count) VALUES (1, 'Keyboards', 3, 3)");
        $this->addSql("INSERT INTO set (author_id, name, image_id, word_count) VALUES (1, 'Monitors', 4, 5)");
        $this->addSql("INSERT INTO set (author_id, name, image_id, word_count) VALUES (1, 'Mouse', 5, 2)");
        $this->addSql("INSERT INTO set (author_id, name, image_id, word_count) VALUES (1, 'Printers', 6, 6)");

        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Clock Speed', 'Prędkość Zegara')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Core', 'Rdzeń')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Cache', 'Pamięć podręczna')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Arithmetic Logic Unit', 'Jednostka Arytmetyczno-Logiczna')");

        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Capacity', 'Pojemność')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Durability', 'Wytrzymałośc')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Portability', 'Przenośność')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Non-volatile', 'Nielotny')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Reliability', 'Pewnośc/Solidność')");

        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Typewriter', 'Maszyna do pisania')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Function Keys', 'Przyciski Funkcyjne')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Numeric Keypad', 'Klawiatura Numeryczna')");

        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('CRT', 'Kineskop')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('LCD ', 'Wyświetlacz Ciekłokrystaliczny')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('LED', 'Dioda Świecąca')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Resolution', 'Rozdzielczośc')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Refresh Rate', 'Częstotliwość Odświerzania')");

        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('DPI', 'Prędkośc myszki')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Scroll', 'Rolka')");

        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Ink', 'Tusz')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Inkjet Printer', 'Drukarka Atramentowa')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Laser Printer', 'Drukarka Laserowa')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('3D Printer', 'Drukarka 3D')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Thermal Printer', 'Drukarka Termiczna')");
        $this->addSql("INSERT INTO word (word_en, word_pl) VALUES ('Print Spool', 'Kolejka Drukowania')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DELETE FROM set WHERE name IN ('Monitors')");

        $this->addSql("DELETE FROM word WHERE word_en IN ('word1', 'word2', 'word3')");
    }
}
