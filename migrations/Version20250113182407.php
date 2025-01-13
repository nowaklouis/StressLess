<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250113182407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE choices ADD questions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE choices ADD CONSTRAINT FK_5CE9639BCB134CE FOREIGN KEY (questions_id) REFERENCES questions (id)');
        $this->addSql('CREATE INDEX IDX_5CE9639BCB134CE ON choices (questions_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE choices DROP FOREIGN KEY FK_5CE9639BCB134CE');
        $this->addSql('DROP INDEX IDX_5CE9639BCB134CE ON choices');
        $this->addSql('ALTER TABLE choices DROP questions_id');
    }
}
