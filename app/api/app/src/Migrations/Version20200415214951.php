<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200415214951 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE hairdresser_stand_reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE hairdresser_stand_reservation (id INT NOT NULL, hairdresser_stand_id INT NOT NULL, user_id INT NOT NULL, start_hour TIME(0) WITHOUT TIME ZONE NOT NULL, end_hour TIME(0) WITHOUT TIME ZONE NOT NULL, date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C923B8E93DD8CBEE ON hairdresser_stand_reservation (hairdresser_stand_id)');
        $this->addSql('CREATE INDEX IDX_C923B8E9A76ED395 ON hairdresser_stand_reservation (user_id)');
        $this->addSql('ALTER TABLE hairdresser_stand_reservation ADD CONSTRAINT FK_C923B8E93DD8CBEE FOREIGN KEY (hairdresser_stand_id) REFERENCES hairdresser_stand (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hairdresser_stand_reservation ADD CONSTRAINT FK_C923B8E9A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE hairdresser_stand_reservation_id_seq CASCADE');
        $this->addSql('DROP TABLE hairdresser_stand_reservation');
    }
}
