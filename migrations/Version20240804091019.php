<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240804091019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment ADD doctors_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8446425CC19 FOREIGN KEY (doctors_id) REFERENCES doctor (id)');
        $this->addSql('CREATE INDEX IDX_FE38F8446425CC19 ON appointment (doctors_id)');
        $this->addSql('ALTER TABLE doctor ADD department VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE patient ADD appointment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBE5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id)');
        $this->addSql('CREATE INDEX IDX_1ADAD7EBE5B533F9 ON patient (appointment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8446425CC19');
        $this->addSql('DROP INDEX IDX_FE38F8446425CC19 ON appointment');
        $this->addSql('ALTER TABLE appointment DROP doctors_id');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBE5B533F9');
        $this->addSql('DROP INDEX IDX_1ADAD7EBE5B533F9 ON patient');
        $this->addSql('ALTER TABLE patient DROP appointment_id');
        $this->addSql('ALTER TABLE doctor DROP department');
    }
}
