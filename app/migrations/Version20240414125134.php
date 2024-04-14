<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240414125134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ADD user_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6499D419299 FOREIGN KEY (user_type_id) REFERENCES user_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8D93D6499D419299 ON "user" (user_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6499D419299');
        $this->addSql('DROP INDEX IDX_8D93D6499D419299');
        $this->addSql('ALTER TABLE "user" DROP user_type_id');
    }
}
