<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240607200101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE micropost ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE micropost ADD CONSTRAINT FK_18996072A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_18996072A76ED395 ON micropost (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE micropost DROP FOREIGN KEY FK_18996072A76ED395');
        $this->addSql('DROP INDEX IDX_18996072A76ED395 ON micropost');
        $this->addSql('ALTER TABLE micropost DROP user_id');
    }
}
