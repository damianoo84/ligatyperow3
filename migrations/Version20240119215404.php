<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119215404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meet ADD host_team_id INT NOT NULL, ADD guest_team_id INT NOT NULL');
        $this->addSql('ALTER TABLE meet ADD CONSTRAINT FK_E9F6D3CE1E90F49F FOREIGN KEY (host_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE meet ADD CONSTRAINT FK_E9F6D3CE69A91CE2 FOREIGN KEY (guest_team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_E9F6D3CE1E90F49F ON meet (host_team_id)');
        $this->addSql('CREATE INDEX IDX_E9F6D3CE69A91CE2 ON meet (guest_team_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meet DROP FOREIGN KEY FK_E9F6D3CE1E90F49F');
        $this->addSql('ALTER TABLE meet DROP FOREIGN KEY FK_E9F6D3CE69A91CE2');
        $this->addSql('DROP INDEX IDX_E9F6D3CE1E90F49F ON meet');
        $this->addSql('DROP INDEX IDX_E9F6D3CE69A91CE2 ON meet');
        $this->addSql('ALTER TABLE meet DROP host_team_id, DROP guest_team_id');
    }
}
