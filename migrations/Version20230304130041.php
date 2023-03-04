<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230304130041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE game_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE game (id INT NOT NULL, home_team_id INT NOT NULL, away_team_id INT NOT NULL, match_league_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_232B318C9C4C13F6 ON game (home_team_id)');
        $this->addSql('CREATE INDEX IDX_232B318C45185D02 ON game (away_team_id)');
        $this->addSql('CREATE TABLE team (id INT NOT NULL, name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C9C4C13F6 FOREIGN KEY (home_team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C45185D02 FOREIGN KEY (away_team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C9C4C13F6');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C45185D02');
        $this->addSql('DROP SEQUENCE game_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE team_id_seq CASCADE');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE team');
    }
}
