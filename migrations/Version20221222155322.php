<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221222155322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F34FFA69A');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FBCF5E72D');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F37D925CB');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FDBD5322');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4296D31F');
        $this->addSql('DROP TABLE image');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, patron_id INT DEFAULT NULL, creation_id INT DEFAULT NULL, livre_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, genre_id INT DEFAULT NULL, chemin VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_C53D045FDBD5322 (patron_id), INDEX IDX_C53D045F37D925CB (livre_id), INDEX IDX_C53D045F4296D31F (genre_id), INDEX IDX_C53D045F34FFA69A (creation_id), INDEX IDX_C53D045FBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F34FFA69A FOREIGN KEY (creation_id) REFERENCES creation (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FDBD5322 FOREIGN KEY (patron_id) REFERENCES patron (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
    }
}
