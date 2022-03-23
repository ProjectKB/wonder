<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220322104424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vote (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, question_id INTEGER DEFAULT NULL, comment_id INTEGER DEFAULT NULL, is_liked BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_5A108564F675F31B ON vote (author_id)');
        $this->addSql('CREATE INDEX IDX_5A1085641E27F6BF ON vote (question_id)');
        $this->addSql('CREATE INDEX IDX_5A108564F8697D13 ON vote (comment_id)');
        $this->addSql('DROP INDEX IDX_9474526C1E27F6BF');
        $this->addSql('DROP INDEX IDX_9474526CF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, question_id, author_id, content, rating, created_at FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, question_id INTEGER NOT NULL, author_id INTEGER NOT NULL, content CLOB NOT NULL, rating INTEGER NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_9474526C1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO comment (id, question_id, author_id, content, rating, created_at) SELECT id, question_id, author_id, content, rating, created_at FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
        $this->addSql('CREATE INDEX IDX_9474526C1E27F6BF ON comment (question_id)');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('DROP INDEX IDX_B6F7494EF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__question AS SELECT id, author_id, title, content, created_at, rating, nbr_of_response FROM question');
        $this->addSql('DROP TABLE question');
        $this->addSql('CREATE TABLE question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, content CLOB NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , rating INTEGER NOT NULL, nbr_of_response INTEGER NOT NULL, CONSTRAINT FK_B6F7494EF675F31B FOREIGN KEY (author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO question (id, author_id, title, content, created_at, rating, nbr_of_response) SELECT id, author_id, title, content, created_at, rating, nbr_of_response FROM __temp__question');
        $this->addSql('DROP TABLE __temp__question');
        $this->addSql('CREATE INDEX IDX_B6F7494EF675F31B ON question (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vote');
        $this->addSql('DROP INDEX IDX_9474526C1E27F6BF');
        $this->addSql('DROP INDEX IDX_9474526CF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, question_id, author_id, content, rating, created_at FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, question_id INTEGER NOT NULL, author_id INTEGER NOT NULL, content CLOB NOT NULL, rating INTEGER NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO comment (id, question_id, author_id, content, rating, created_at) SELECT id, question_id, author_id, content, rating, created_at FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
        $this->addSql('CREATE INDEX IDX_9474526C1E27F6BF ON comment (question_id)');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('DROP INDEX IDX_B6F7494EF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__question AS SELECT id, author_id, title, content, created_at, rating, nbr_of_response FROM question');
        $this->addSql('DROP TABLE question');
        $this->addSql('CREATE TABLE question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, content CLOB NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , rating INTEGER NOT NULL, nbr_of_response INTEGER NOT NULL)');
        $this->addSql('INSERT INTO question (id, author_id, title, content, created_at, rating, nbr_of_response) SELECT id, author_id, title, content, created_at, rating, nbr_of_response FROM __temp__question');
        $this->addSql('DROP TABLE __temp__question');
        $this->addSql('CREATE INDEX IDX_B6F7494EF675F31B ON question (author_id)');
    }
}
