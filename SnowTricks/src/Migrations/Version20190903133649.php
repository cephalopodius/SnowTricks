<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190903133649 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP picture');
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783A7294869C');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783A7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article ADD picture VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783A7294869C');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783A7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
    }
}
