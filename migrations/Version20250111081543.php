<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250111081543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contenu ADD type_id INT NOT NULL, ADD file_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contenu ADD CONSTRAINT FK_89C2003FC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE contenu ADD CONSTRAINT FK_89C2003F93CB796C FOREIGN KEY (file_id) REFERENCES file (id)');
        $this->addSql('CREATE INDEX IDX_89C2003FC54C8C93 ON contenu (type_id)');
        $this->addSql('CREATE INDEX IDX_89C2003F93CB796C ON contenu (file_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenu DROP FOREIGN KEY FK_89C2003F93CB796C');
        $this->addSql('ALTER TABLE contenu DROP FOREIGN KEY FK_89C2003FC54C8C93');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP INDEX IDX_89C2003FC54C8C93 ON contenu');
        $this->addSql('DROP INDEX IDX_89C2003F93CB796C ON contenu');
        $this->addSql('ALTER TABLE contenu DROP type_id, DROP file_id');
    }
}
