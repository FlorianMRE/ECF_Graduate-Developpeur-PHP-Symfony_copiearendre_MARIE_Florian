<?php

declare(strict_types=1);

namespace old_Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517135645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_informations (id INT AUTO_INCREMENT NOT NULL, tel VARCHAR(10) NOT NULL, history LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, address_number VARCHAR(10) NOT NULL, address_street VARCHAR(255) NOT NULL, address_zipcode VARCHAR(100) NOT NULL, address_city VARCHAR(255) NOT NULL, client_firstname VARCHAR(255) DEFAULT NULL, client_lastname VARCHAR(255) NOT NULL, entreprise_name VARCHAR(255) NOT NULL, siret_number VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user CHANGE phone_tel phone_tel VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE client_informations');
        $this->addSql('ALTER TABLE user CHANGE phone_tel phone_tel VARCHAR(10) NOT NULL');
    }
}
