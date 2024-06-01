<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601083932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ALTER COLUMN id SET DEFAULT nextval(\'user_id_seq\')');
        $this->addSql('ALTER TABLE "set" ALTER COLUMN id SET DEFAULT nextval(\'set_id_seq\')');
        $this->addSql('ALTER TABLE "word" ALTER COLUMN id SET DEFAULT nextval(\'word_id_seq\')');

        $hashedPassword1 = password_hash('admin', PASSWORD_BCRYPT);
        $hashedPassword2 = password_hash('user', PASSWORD_BCRYPT);
        $hashedPassword3 = password_hash('user', PASSWORD_BCRYPT);

        $this->addSql("INSERT INTO \"user\" (login, password, email, profile_picture_path, roles) VALUES ('admin', '$hashedPassword1', 'admin@admin.com', 'assets/profile.png', '[\"ROLE_ADMIN\"]')");
        $this->addSql("INSERT INTO \"user\" (login, password, email, profile_picture_path, roles) VALUES ('user', '$hashedPassword2', 'user@user.com', 'assets/profile.png', '[\"ROLE_USER\"]')");
        $this->addSql("INSERT INTO \"user\" (login, password, email, profile_picture_path, roles) VALUES ('user2', '$hashedPassword3', 'user2@user.com', 'assets/profile.png', '[\"ROLE_USER\"]')");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM \"user\" WHERE email IN ('user@user.com', 'user2@user.com', 'admin@admin.com')");

    }
}
