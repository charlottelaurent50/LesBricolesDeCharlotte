<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221229124205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patron_user DROP FOREIGN KEY FK_B12E8B0CDBD5322');
        $this->addSql('ALTER TABLE patron_user DROP FOREIGN KEY FK_B12E8B0CA76ED395');
        $this->addSql('DROP TABLE patron_user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE patron_user (patron_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B12E8B0CDBD5322 (patron_id), INDEX IDX_B12E8B0CA76ED395 (user_id), PRIMARY KEY(patron_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE patron_user ADD CONSTRAINT FK_B12E8B0CDBD5322 FOREIGN KEY (patron_id) REFERENCES patron (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patron_user ADD CONSTRAINT FK_B12E8B0CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }
}
