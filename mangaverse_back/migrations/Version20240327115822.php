<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240327115822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE genre_oeuvre (genre_id INT NOT NULL, oeuvre_id INT NOT NULL, INDEX IDX_DE4D1EDE4296D31F (genre_id), INDEX IDX_DE4D1EDE88194DE8 (oeuvre_id), PRIMARY KEY(genre_id, oeuvre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE genre_oeuvre ADD CONSTRAINT FK_DE4D1EDE4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_oeuvre ADD CONSTRAINT FK_DE4D1EDE88194DE8 FOREIGN KEY (oeuvre_id) REFERENCES oeuvre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvre ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE oeuvre ADD CONSTRAINT FK_35FE2EFEC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_35FE2EFEC54C8C93 ON oeuvre (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE genre_oeuvre DROP FOREIGN KEY FK_DE4D1EDE4296D31F');
        $this->addSql('ALTER TABLE genre_oeuvre DROP FOREIGN KEY FK_DE4D1EDE88194DE8');
        $this->addSql('DROP TABLE genre_oeuvre');
        $this->addSql('ALTER TABLE oeuvre DROP FOREIGN KEY FK_35FE2EFEC54C8C93');
        $this->addSql('DROP INDEX IDX_35FE2EFEC54C8C93 ON oeuvre');
        $this->addSql('ALTER TABLE oeuvre DROP type_id');
    }
}
