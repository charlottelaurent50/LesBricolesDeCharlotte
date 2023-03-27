<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221222114905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accessoire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creation (id INT AUTO_INCREMENT NOT NULL, date DATE DEFAULT NULL, tissu VARCHAR(100) DEFAULT NULL, remarque VARCHAR(255) DEFAULT NULL, lien_insta VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, patron_id INT DEFAULT NULL, creation_id INT DEFAULT NULL, livre_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, genre_id INT DEFAULT NULL, chemin VARCHAR(255) NOT NULL, INDEX IDX_C53D045FDBD5322 (patron_id), INDEX IDX_C53D045F34FFA69A (creation_id), INDEX IDX_C53D045F37D925CB (livre_id), INDEX IDX_C53D045FBCF5E72D (categorie_id), INDEX IDX_C53D045F4296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patron (id INT AUTO_INCREMENT NOT NULL, livre_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, genre_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, ma_taille DOUBLE PRECISION DEFAULT NULL, metrage VARCHAR(50) NOT NULL, tissu VARCHAR(150) NOT NULL, remarque VARCHAR(255) DEFAULT NULL, decalque TINYINT(1) DEFAULT NULL, taille_decalque VARCHAR(25) DEFAULT NULL, INDEX IDX_E5F5425D37D925CB (livre_id), INDEX IDX_E5F5425DBCF5E72D (categorie_id), INDEX IDX_E5F5425D4296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patron_creation (patron_id INT NOT NULL, creation_id INT NOT NULL, INDEX IDX_E1443CEADBD5322 (patron_id), INDEX IDX_E1443CEA34FFA69A (creation_id), PRIMARY KEY(patron_id, creation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patron_user (patron_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B12E8B0CDBD5322 (patron_id), INDEX IDX_B12E8B0CA76ED395 (user_id), PRIMARY KEY(patron_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilise (id INT AUTO_INCREMENT NOT NULL, patron_id INT DEFAULT NULL, accessoire_id INT NOT NULL, quantite VARCHAR(50) NOT NULL, INDEX IDX_28917DEFDBD5322 (patron_id), INDEX IDX_28917DEFD23B67ED (accessoire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FDBD5322 FOREIGN KEY (patron_id) REFERENCES patron (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F34FFA69A FOREIGN KEY (creation_id) REFERENCES creation (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE patron ADD CONSTRAINT FK_E5F5425D37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE patron ADD CONSTRAINT FK_E5F5425DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE patron ADD CONSTRAINT FK_E5F5425D4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE patron_creation ADD CONSTRAINT FK_E1443CEADBD5322 FOREIGN KEY (patron_id) REFERENCES patron (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patron_creation ADD CONSTRAINT FK_E1443CEA34FFA69A FOREIGN KEY (creation_id) REFERENCES creation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patron_user ADD CONSTRAINT FK_B12E8B0CDBD5322 FOREIGN KEY (patron_id) REFERENCES patron (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patron_user ADD CONSTRAINT FK_B12E8B0CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilise ADD CONSTRAINT FK_28917DEFDBD5322 FOREIGN KEY (patron_id) REFERENCES patron (id)');
        $this->addSql('ALTER TABLE utilise ADD CONSTRAINT FK_28917DEFD23B67ED FOREIGN KEY (accessoire_id) REFERENCES accessoire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FDBD5322');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F34FFA69A');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F37D925CB');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FBCF5E72D');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4296D31F');
        $this->addSql('ALTER TABLE patron DROP FOREIGN KEY FK_E5F5425D37D925CB');
        $this->addSql('ALTER TABLE patron DROP FOREIGN KEY FK_E5F5425DBCF5E72D');
        $this->addSql('ALTER TABLE patron DROP FOREIGN KEY FK_E5F5425D4296D31F');
        $this->addSql('ALTER TABLE patron_creation DROP FOREIGN KEY FK_E1443CEADBD5322');
        $this->addSql('ALTER TABLE patron_creation DROP FOREIGN KEY FK_E1443CEA34FFA69A');
        $this->addSql('ALTER TABLE patron_user DROP FOREIGN KEY FK_B12E8B0CDBD5322');
        $this->addSql('ALTER TABLE patron_user DROP FOREIGN KEY FK_B12E8B0CA76ED395');
        $this->addSql('ALTER TABLE utilise DROP FOREIGN KEY FK_28917DEFDBD5322');
        $this->addSql('ALTER TABLE utilise DROP FOREIGN KEY FK_28917DEFD23B67ED');
        $this->addSql('DROP TABLE accessoire');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE creation');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE patron');
        $this->addSql('DROP TABLE patron_creation');
        $this->addSql('DROP TABLE patron_user');
        $this->addSql('DROP TABLE utilise');
    }
}
