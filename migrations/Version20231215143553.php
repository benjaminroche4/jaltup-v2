<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215143553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company ADD name VARCHAR(255) NOT NULL, ADD logo_url VARCHAR(255) NOT NULL, ADD uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', ADD employee_count_range VARCHAR(255) NOT NULL, ADD status LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD bio VARCHAR(255) DEFAULT NULL, ADD contact_email VARCHAR(255) NOT NULL, ADD phone_number VARCHAR(255) NOT NULL, ADD website_url VARCHAR(255) DEFAULT NULL, ADD slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP name, DROP logo_url, DROP uuid, DROP employee_count_range, DROP status, DROP created_at, DROP bio, DROP contact_email, DROP phone_number, DROP website_url, DROP slug');
    }
}
