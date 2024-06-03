<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603105000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE set_history_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE set_history (id INT NOT NULL, set_id INT NOT NULL, usr_id INT NOT NULL, timestamp TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A01696AC10FB0D18 ON set_history (set_id)');
        $this->addSql('CREATE INDEX IDX_A01696ACC69D3FB ON set_history (usr_id)');
        $this->addSql('ALTER TABLE set_history ADD CONSTRAINT FK_A01696AC10FB0D18 FOREIGN KEY (set_id) REFERENCES set (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE set_history ADD CONSTRAINT FK_A01696ACC69D3FB FOREIGN KEY (usr_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE image ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE set ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE word ALTER id DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE set_history_id_seq CASCADE');
        $this->addSql('ALTER TABLE set_history DROP CONSTRAINT FK_A01696AC10FB0D18');
        $this->addSql('ALTER TABLE set_history DROP CONSTRAINT FK_A01696ACC69D3FB');
        $this->addSql('DROP TABLE set_history');
        $this->addSql('CREATE SEQUENCE set_id_seq');
        $this->addSql('SELECT setval(\'set_id_seq\', (SELECT MAX(id) FROM set))');
        $this->addSql('ALTER TABLE set ALTER id SET DEFAULT nextval(\'set_id_seq\')');
        $this->addSql('CREATE SEQUENCE word_id_seq');
        $this->addSql('SELECT setval(\'word_id_seq\', (SELECT MAX(id) FROM word))');
        $this->addSql('ALTER TABLE word ALTER id SET DEFAULT nextval(\'word_id_seq\')');
        $this->addSql('CREATE SEQUENCE user_id_seq');
        $this->addSql('SELECT setval(\'user_id_seq\', (SELECT MAX(id) FROM "user"))');
        $this->addSql('ALTER TABLE "user" ALTER id SET DEFAULT nextval(\'user_id_seq\')');
        $this->addSql('CREATE SEQUENCE image_id_seq');
        $this->addSql('SELECT setval(\'image_id_seq\', (SELECT MAX(id) FROM image))');
        $this->addSql('ALTER TABLE image ALTER id SET DEFAULT nextval(\'image_id_seq\')');
    }
}
