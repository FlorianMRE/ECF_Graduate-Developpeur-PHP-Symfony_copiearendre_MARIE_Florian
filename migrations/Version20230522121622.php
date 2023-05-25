<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522121622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images RENAME INDEX idx_e01fbe6a9f1d6087 TO IDX_E01FBE6A6C8A81A9');
        $this->addSql('ALTER TABLE products ADD published_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images RENAME INDEX idx_e01fbe6a6c8a81a9 TO IDX_E01FBE6A9F1D6087');
        $this->addSql('ALTER TABLE products DROP published_at');
    }
}
