<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221222155034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE creation ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE genre ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE livre ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE patron ADD image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP image');
        $this->addSql('ALTER TABLE creation DROP image');
        $this->addSql('ALTER TABLE genre DROP image');
        $this->addSql('ALTER TABLE livre DROP image');
        $this->addSql('ALTER TABLE patron DROP image');
    }
}
