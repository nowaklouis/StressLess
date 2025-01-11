<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250111092025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, contenu_id INT DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_C53D045F3C1CC488 (contenu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F3C1CC488 FOREIGN KEY (contenu_id) REFERENCES contenu (id)');
        $this->addSql('ALTER TABLE contenu ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contenu ADD CONSTRAINT FK_89C2003F3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_89C2003F3DA5256D ON contenu (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenu DROP FOREIGN KEY FK_89C2003F3DA5256D');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F3C1CC488');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP INDEX IDX_89C2003F3DA5256D ON contenu');
        $this->addSql('ALTER TABLE contenu DROP image_id');
    }
}
