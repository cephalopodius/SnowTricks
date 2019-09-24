<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190923140150 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, main_picture TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, groupe_id INT NOT NULL, title VARCHAR(255) NOT NULL, content TINYTEXT NOT NULL, published_at DATETIME NOT NULL, INDEX IDX_23A0E66F675F31B (author_id), INDEX IDX_23A0E667A45358C (groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, author_id_id INT NOT NULL, content LONGTEXT NOT NULL, comment_date DATETIME NOT NULL, INDEX IDX_9474526C7294869C (article_id), INDEX IDX_9474526C69CCBE9A (author_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, groupname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, nickname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, article_video_id INT NOT NULL, link VARCHAR(255) NOT NULL, INDEX IDX_7CC7DA2C7C29F425 (article_video_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783ABF396750 FOREIGN KEY (id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E667A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C69CCBE9A FOREIGN KEY (author_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C7C29F425 FOREIGN KEY (article_video_id) REFERENCES article (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783ABF396750');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7294869C');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C7C29F425');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E667A45358C');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66F675F31B');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C69CCBE9A');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE video');
    }
}
