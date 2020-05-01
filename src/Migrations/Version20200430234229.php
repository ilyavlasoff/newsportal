<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430234229 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE confirmation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE author_requests_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE confirmation (id INT NOT NULL, for_user INT NOT NULL, key VARCHAR(255) NOT NULL, expired TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_483D123C5E26B7DC ON confirmation (for_user)');
        $this->addSql('CREATE TABLE author_requests (id INT NOT NULL, name VARCHAR(30) NOT NULL, surname VARCHAR(30) NOT NULL, country VARCHAR(30) NOT NULL, birthday DATE DEFAULT NULL, language VARCHAR(80) DEFAULT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(30) NOT NULL, edu VARCHAR(128) DEFAULT NULL, categories VARCHAR(80) DEFAULT NULL, bio VARCHAR(512) DEFAULT NULL, previous_works VARCHAR(512) DEFAULT NULL, other VARCHAR(512) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE confirmation ADD CONSTRAINT FK_483D123C5E26B7DC FOREIGN KEY (for_user) REFERENCES usr (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE usr ADD is_activated BOOLEAN NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE confirmation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE author_requests_id_seq CASCADE');
        $this->addSql('DROP TABLE confirmation');
        $this->addSql('DROP TABLE author_requests');
        $this->addSql('ALTER TABLE usr DROP is_activated');
    }
}
