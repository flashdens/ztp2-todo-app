<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250709154908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(64) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(64) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE notes (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, title VARCHAR(255) NOT NULL, text VARCHAR(1024) DEFAULT NULL, category_id INT NOT NULL, INDEX IDX_11BA68C12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE tasks (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, title VARCHAR(255) NOT NULL, comment VARCHAR(1024) DEFAULT NULL, category_id INT NOT NULL, INDEX IDX_5058659712469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notes ADD CONSTRAINT FK_11BA68C12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE tasks ADD CONSTRAINT FK_5058659712469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE notes DROP FOREIGN KEY FK_11BA68C12469DE2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE tasks DROP FOREIGN KEY FK_5058659712469DE2
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE categories
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE notes
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE tasks
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE users
        SQL);
    }
}
