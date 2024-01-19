<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119211351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistic (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, match2 INT NOT NULL, match4 INT NOT NULL, total_points INT NOT NULL, position INT NOT NULL, num_of_que INT NOT NULL, INDEX IDX_649B469CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, league_id INT NOT NULL, name INT NOT NULL, shortname VARCHAR(20) NOT NULL, INDEX IDX_C4E0A61F58AFC4DE (league_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, number_of_points INT DEFAULT NULL, host_type INT NOT NULL, guest_type INT NOT NULL, INDEX IDX_8CDE5729A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F58AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE5729A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)');
        $this->addSql('ALTER TABLE meet ADD league_id INT NOT NULL');
        $this->addSql('ALTER TABLE meet ADD CONSTRAINT FK_E9F6D3CE58AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
        $this->addSql('CREATE INDEX IDX_E9F6D3CE58AFC4DE ON meet (league_id)');
        $this->addSql('ALTER TABLE user ADD phone VARCHAR(9) NOT NULL, ADD number_of_wins INT NOT NULL, ADD status INT NOT NULL, ADD priority INT NOT NULL, ADD last_activity_at DATETIME DEFAULT NULL, ADD ranking_position INT DEFAULT NULL, ADD max_points_per_queue INT DEFAULT NULL, ADD min_points_per_queue INT DEFAULT NULL, ADD nick VARCHAR(20) DEFAULT NULL, ADD favorite_poland_team VARCHAR(255) DEFAULT NULL, ADD favorite_foreign_team VARCHAR(255) DEFAULT NULL, ADD number_of_first_places INT DEFAULT NULL, ADD number_of_second_places INT DEFAULT NULL, ADD number_of_third_places INT DEFAULT NULL, ADD last_winner INT DEFAULT NULL, ADD lider_of_ranking INT DEFAULT NULL, ADD created DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CA76ED395');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F58AFC4DE');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE5729A76ED395');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE statistic');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE type');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('DROP INDEX IDX_9474526CA76ED395 ON comment');
        $this->addSql('ALTER TABLE comment DROP user_id');
        $this->addSql('ALTER TABLE meet DROP FOREIGN KEY FK_E9F6D3CE58AFC4DE');
        $this->addSql('DROP INDEX IDX_E9F6D3CE58AFC4DE ON meet');
        $this->addSql('ALTER TABLE meet DROP league_id');
        $this->addSql('ALTER TABLE user DROP phone, DROP number_of_wins, DROP status, DROP priority, DROP last_activity_at, DROP ranking_position, DROP max_points_per_queue, DROP min_points_per_queue, DROP nick, DROP favorite_poland_team, DROP favorite_foreign_team, DROP number_of_first_places, DROP number_of_second_places, DROP number_of_third_places, DROP last_winner, DROP lider_of_ranking, DROP created, DROP updated');
    }
}
