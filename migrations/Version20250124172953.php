<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250124172953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D5CE07E8FF');
        $this->addSql('DROP INDEX IDX_8ADC54D5CE07E8FF ON questions');
        $this->addSql('ALTER TABLE questions DROP questionnaire_id');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFBCE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id)');
        $this->addSql('CREATE INDEX IDX_3E7B0BFBCE07E8FF ON response (questionnaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions ADD questionnaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D5CE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8ADC54D5CE07E8FF ON questions (questionnaire_id)');
        $this->addSql('ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFBCE07E8FF');
        $this->addSql('DROP INDEX IDX_3E7B0BFBCE07E8FF ON response');
    }
}
