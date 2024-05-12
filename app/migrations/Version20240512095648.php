<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240512095648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO \"user\" (id, login, password, email, profile_picture_path, user_type_id) VALUES 
            (1, 'Admin', 'admin', 'admin@admin.com', 'assets/profile/admin.png', 2),
            (2, 'User', 'user', 'user@user.com', 'assets/profile/user.png', 1)
        ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM user WHERE id = 1');
        $this->addSql('DELETE FROM user WHERE id = 2');
    }
}
