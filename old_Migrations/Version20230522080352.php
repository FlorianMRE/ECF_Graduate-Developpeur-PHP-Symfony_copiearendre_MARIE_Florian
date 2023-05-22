<?php

declare(strict_types=1);

namespace old_Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522080352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A9F1D6087');
        $this->addSql('DROP INDEX IDX_E01FBE6A9F1D6087 ON images');
        $this->addSql('ALTER TABLE images CHANGE products_id products_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A9F1D6087 FOREIGN KEY (products_id) REFERENCES products (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A9F1D6087 ON images (products_id)');
        $this->addSql('ALTER TABLE products ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A9F1D6087');
        $this->addSql('DROP INDEX IDX_E01FBE6A9F1D6087 ON images');
        $this->addSql('ALTER TABLE images CHANGE products_id products_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A9F1D6087 FOREIGN KEY (products_id) REFERENCES products (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A9F1D6087 ON images (products_id)');
        $this->addSql('ALTER TABLE products DROP created_at, DROP updated_at');
    }
}
