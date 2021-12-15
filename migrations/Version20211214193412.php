<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214193412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cataloguefront DROP FOREIGN KEY FK_C58FACE2E6D6B297');
        $this->addSql('DROP INDEX idx_c58face2e6d6b297 ON cataloguefront');
        $this->addSql('CREATE INDEX IDX_8EBD43AE6D6B297 ON cataloguefront (profil)');
        $this->addSql('ALTER TABLE cataloguefront ADD CONSTRAINT FK_C58FACE2E6D6B297 FOREIGN KEY (profil) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE menu_content_page CHANGE dataCreation dataCreation DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE statut_juridique CHANGE dateinscription dateinscription DATETIME NOT NULL, CHANGE datemodification datemodification DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cataloguefront DROP FOREIGN KEY FK_8EBD43AE6D6B297');
        $this->addSql('DROP INDEX idx_8ebd43ae6d6b297 ON cataloguefront');
        $this->addSql('CREATE INDEX IDX_C58FACE2E6D6B297 ON cataloguefront (profil)');
        $this->addSql('ALTER TABLE cataloguefront ADD CONSTRAINT FK_8EBD43AE6D6B297 FOREIGN KEY (profil) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE menu_content_page CHANGE dataCreation dataCreation DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE statut_juridique CHANGE dateinscription dateinscription DATETIME NOT NULL, CHANGE datemodification datemodification DATETIME DEFAULT NULL');
    }
}
