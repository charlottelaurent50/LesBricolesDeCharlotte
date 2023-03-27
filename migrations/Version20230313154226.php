<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313154226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE patron_creation (patron_id INT NOT NULL, creation_id INT NOT NULL, INDEX IDX_E1443CEADBD5322 (patron_id), INDEX IDX_E1443CEA34FFA69A (creation_id), PRIMARY KEY(patron_id, creation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patron_creation ADD CONSTRAINT FK_E1443CEADBD5322 FOREIGN KEY (patron_id) REFERENCES patron (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patron_creation ADD CONSTRAINT FK_E1443CEA34FFA69A FOREIGN KEY (creation_id) REFERENCES creation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fait_avec DROP FOREIGN KEY FK_FE3879DA34FFA69A');
        $this->addSql('ALTER TABLE fait_avec DROP FOREIGN KEY FK_FE3879DADBD5322');
        $this->addSql('DROP TABLE fait_avec');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fait_avec (id INT AUTO_INCREMENT NOT NULL, patron_id INT DEFAULT NULL, creation_id INT DEFAULT NULL, INDEX IDX_FE3879DA34FFA69A (creation_id), INDEX IDX_FE3879DADBD5322 (patron_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE fait_avec ADD CONSTRAINT FK_FE3879DA34FFA69A FOREIGN KEY (creation_id) REFERENCES creation (id)');
        $this->addSql('ALTER TABLE fait_avec ADD CONSTRAINT FK_FE3879DADBD5322 FOREIGN KEY (patron_id) REFERENCES patron (id)');
        $this->addSql('ALTER TABLE patron_creation DROP FOREIGN KEY FK_E1443CEADBD5322');
        $this->addSql('ALTER TABLE patron_creation DROP FOREIGN KEY FK_E1443CEA34FFA69A');
        $this->addSql('DROP TABLE patron_creation');
    }
}
