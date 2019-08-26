<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190807144357 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_472B783A7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, groupname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, link VARCHAR(255) NOT NULL, INDEX IDX_7CC7DA2C7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783A7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article ADD author_id INT NOT NULL, ADD groupe_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E667A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66F675F31B ON article (author_id)');
        $this->addSql('CREATE INDEX IDX_23A0E667A45358C ON article (groupe_id)');
        $this->addSql('ALTER TABLE comment CHANGE author_id author_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C69CCBE9A FOREIGN KEY (author_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9474526C69CCBE9A ON comment (author_id_id)');
        $this->addSql('ALTER TABLE user ADD picture VARCHAR(255) DEFAULT NULL, ADD nickname VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E667A45358C');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE video');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66F675F31B');
        $this->addSql('DROP INDEX IDX_23A0E66F675F31B ON article');
        $this->addSql('DROP INDEX IDX_23A0E667A45358C ON article');
        $this->addSql('ALTER TABLE article DROP author_id, DROP groupe_id');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C69CCBE9A');
        $this->addSql('DROP INDEX IDX_9474526C69CCBE9A ON comment');
        $this->addSql('ALTER TABLE comment CHANGE author_id_id author_id INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP picture, DROP nickname');
    }
}
