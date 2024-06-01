<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601133000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO image (image_name) VALUES ('cpu.png')");
        $this->addSql("INSERT INTO image (image_name) VALUES ('hdd.png')");
        $this->addSql("INSERT INTO image (image_name) VALUES ('keyboard.png')");
        $this->addSql("INSERT INTO image (image_name) VALUES ('monitor.png')");
        $this->addSql("INSERT INTO image (image_name) VALUES ('mouse.png')");
        $this->addSql("INSERT INTO image (image_name) VALUES ('printer.png')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql("DELETE FROM image WHERE image_name IN ('cpu.png', 'hdd.png', 'keyboard.png', 'monitor.png', 'mouse.png', 'printer.png')");
    }
}
