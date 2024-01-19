<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119212548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD season_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('CREATE INDEX IDX_9474526C4EC001D1 ON comment (season_id)');
        $this->addSql('ALTER TABLE history ADD matchday_id INT NOT NULL, ADD statistic_id INT NOT NULL');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B3D90D21B FOREIGN KEY (matchday_id) REFERENCES matchday (id)');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B53B6268F FOREIGN KEY (statistic_id) REFERENCES statistic (id)');
        $this->addSql('CREATE INDEX IDX_27BA704B3D90D21B ON history (matchday_id)');
        $this->addSql('CREATE INDEX IDX_27BA704B53B6268F ON history (statistic_id)');
        $this->addSql('ALTER TABLE matchday ADD season_id INT NOT NULL');
        $this->addSql('ALTER TABLE matchday ADD CONSTRAINT FK_A95F40764EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('CREATE INDEX IDX_A95F40764EC001D1 ON matchday (season_id)');
        $this->addSql('ALTER TABLE meet ADD matchday_id INT NOT NULL');
        $this->addSql('ALTER TABLE meet ADD CONSTRAINT FK_E9F6D3CE3D90D21B FOREIGN KEY (matchday_id) REFERENCES matchday (id)');
        $this->addSql('CREATE INDEX IDX_E9F6D3CE3D90D21B ON meet (matchday_id)');
        $this->addSql('ALTER TABLE statistic ADD season_id INT NOT NULL');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('CREATE INDEX IDX_649B469C4EC001D1 ON statistic (season_id)');
        $this->addSql('ALTER TABLE type ADD meet_id INT NOT NULL');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE57293BBBF66 FOREIGN KEY (meet_id) REFERENCES meet (id)');
        $this->addSql('CREATE INDEX IDX_8CDE57293BBBF66 ON type (meet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4EC001D1');
        $this->addSql('DROP INDEX IDX_9474526C4EC001D1 ON comment');
        $this->addSql('ALTER TABLE comment DROP season_id');
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704B3D90D21B');
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704B53B6268F');
        $this->addSql('DROP INDEX IDX_27BA704B3D90D21B ON history');
        $this->addSql('DROP INDEX IDX_27BA704B53B6268F ON history');
        $this->addSql('ALTER TABLE history DROP matchday_id, DROP statistic_id');
        $this->addSql('ALTER TABLE matchday DROP FOREIGN KEY FK_A95F40764EC001D1');
        $this->addSql('DROP INDEX IDX_A95F40764EC001D1 ON matchday');
        $this->addSql('ALTER TABLE matchday DROP season_id');
        $this->addSql('ALTER TABLE meet DROP FOREIGN KEY FK_E9F6D3CE3D90D21B');
        $this->addSql('DROP INDEX IDX_E9F6D3CE3D90D21B ON meet');
        $this->addSql('ALTER TABLE meet DROP matchday_id');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469C4EC001D1');
        $this->addSql('DROP INDEX IDX_649B469C4EC001D1 ON statistic');
        $this->addSql('ALTER TABLE statistic DROP season_id');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE57293BBBF66');
        $this->addSql('DROP INDEX IDX_8CDE57293BBBF66 ON type');
        $this->addSql('ALTER TABLE type DROP meet_id');
    }
}
