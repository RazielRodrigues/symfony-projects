<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250603144945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create tables for department, registration, and messenger_messages with initial department data';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE department (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);

        $this->addSql(<<<'SQL'
            CREATE TABLE registration (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                plus_one TINYINT(1) NOT NULL, 
                number_kids SMALLINT NOT NULL, 
                number_vegetarians SMALLINT NOT NULL, 
                email VARCHAR(255) NOT NULL, 
                department VARCHAR(255) NOT NULL, 
                UNIQUE INDEX email_unique (email), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);

        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (
                id INT AUTO_INCREMENT NOT NULL, 
                body LONGTEXT NOT NULL, 
                headers LONGTEXT NOT NULL, 
                queue_name VARCHAR(190) NOT NULL, 
                created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', 
                available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', 
                delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', 
                INDEX IDX_75EA56E0FB7336F0 (queue_name), 
                INDEX IDX_75EA56E0E3BD61CE (available_at), 
                INDEX IDX_75EA56E016BA31DB (delivered_at), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);

        // Insert initial departments
        $this->addSql("INSERT INTO department (name) VALUES ('Finance')");
        $this->addSql("INSERT INTO department (name) VALUES ('IT')");
        $this->addSql("INSERT INTO department (name) VALUES ('Sales')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE registration');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
