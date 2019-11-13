<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191002084253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE impression3d ADD utilisateur_id INT NOT NULL, ADD calendrier_id INT NOT NULL');
        $this->addSql('ALTER TABLE impression3d ADD CONSTRAINT FK_BED5EA36FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE impression3d ADD CONSTRAINT FK_BED5EA36FF52FC51 FOREIGN KEY (calendrier_id) REFERENCES calendrier (id)');
        $this->addSql('CREATE INDEX IDX_BED5EA36FB88E14F ON impression3d (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_BED5EA36FF52FC51 ON impression3d (calendrier_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE impression3d DROP FOREIGN KEY FK_BED5EA36FB88E14F');
        $this->addSql('ALTER TABLE impression3d DROP FOREIGN KEY FK_BED5EA36FF52FC51');
        $this->addSql('DROP INDEX IDX_BED5EA36FB88E14F ON impression3d');
        $this->addSql('DROP INDEX IDX_BED5EA36FF52FC51 ON impression3d');
        $this->addSql('ALTER TABLE impression3d DROP utilisateur_id, DROP calendrier_id');
    }
}
