<?php

declare(strict_types=1);

namespace old_Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516141134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD gender VARCHAR(15) NOT NULL, ADD phone_tel VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A9F1D6087');
        $this->addSql('DROP INDEX IDX_E01FBE6A9F1D6087 ON images');
        $this->addSql('ALTER TABLE images CHANGE products_id products_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A9F1D6087 FOREIGN KEY (products_id) REFERENCES products (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A9F1D6087 ON images (products_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A9F1D6087');
        $this->addSql('DROP INDEX IDX_E01FBE6A9F1D6087 ON images');
        $this->addSql('ALTER TABLE images CHANGE products_id products_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A9F1D6087 FOREIGN KEY (products_id) REFERENCES products (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A9F1D6087 ON images (products_id)');
    }
}
