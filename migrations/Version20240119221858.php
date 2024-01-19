<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119221858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD created DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE history ADD created DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE league ADD created DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE matchday ADD created DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE meet ADD created DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE season ADD created DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE statistic ADD created DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE team ADD created DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE type ADD created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD datetime_immutable DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user ADD shortname VARCHAR(20) NOT NULL, ADD email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP created, DROP updated');
        $this->addSql('ALTER TABLE history DROP created, DROP updated');
        $this->addSql('ALTER TABLE league DROP created, DROP updated');
        $this->addSql('ALTER TABLE matchday DROP created, DROP updated');
        $this->addSql('ALTER TABLE meet DROP created, DROP updated');
        $this->addSql('ALTER TABLE season DROP created, DROP updated');
        $this->addSql('ALTER TABLE statistic DROP created, DROP updated');
        $this->addSql('ALTER TABLE team DROP created, DROP updated');
        $this->addSql('ALTER TABLE type DROP created, DROP datetime_immutable');
        $this->addSql('ALTER TABLE user DROP shortname, DROP email');
    }
}
