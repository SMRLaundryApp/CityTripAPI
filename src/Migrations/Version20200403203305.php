<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200403203305 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coordinates (id INT AUTO_INCREMENT NOT NULL, point_of_interest_id INT DEFAULT NULL, longitude NUMERIC(9, 6) NOT NULL, latitude NUMERIC(9, 6) NOT NULL, INDEX IDX_9816D6761FE9DE17 (point_of_interest_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE point_of_interest (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE point_of_interest_category (point_of_interest_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_F6EAAD891FE9DE17 (point_of_interest_id), INDEX IDX_F6EAAD8912469DE2 (category_id), PRIMARY KEY(point_of_interest_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, routes_id INT DEFAULT NULL, latitude NUMERIC(9, 3) NOT NULL, longitude NUMERIC(9, 6) NOT NULL, latitude_delta NUMERIC(4, 2) NOT NULL, longitude_delta NUMERIC(4, 2) NOT NULL, INDEX IDX_F62F176AE2C16DC (routes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE routes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, length NUMERIC(4, 2) NOT NULL, duration INT NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE routes_point_of_interest (routes_id INT NOT NULL, point_of_interest_id INT NOT NULL, INDEX IDX_A4FD6C6FAE2C16DC (routes_id), INDEX IDX_A4FD6C6F1FE9DE17 (point_of_interest_id), PRIMARY KEY(routes_id, point_of_interest_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coordinates ADD CONSTRAINT FK_9816D6761FE9DE17 FOREIGN KEY (point_of_interest_id) REFERENCES point_of_interest (id)');
        $this->addSql('ALTER TABLE point_of_interest_category ADD CONSTRAINT FK_F6EAAD891FE9DE17 FOREIGN KEY (point_of_interest_id) REFERENCES point_of_interest (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE point_of_interest_category ADD CONSTRAINT FK_F6EAAD8912469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F176AE2C16DC FOREIGN KEY (routes_id) REFERENCES routes (id)');
        $this->addSql('ALTER TABLE routes_point_of_interest ADD CONSTRAINT FK_A4FD6C6FAE2C16DC FOREIGN KEY (routes_id) REFERENCES routes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE routes_point_of_interest ADD CONSTRAINT FK_A4FD6C6F1FE9DE17 FOREIGN KEY (point_of_interest_id) REFERENCES point_of_interest (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE point_of_interest_category DROP FOREIGN KEY FK_F6EAAD8912469DE2');
        $this->addSql('ALTER TABLE coordinates DROP FOREIGN KEY FK_9816D6761FE9DE17');
        $this->addSql('ALTER TABLE point_of_interest_category DROP FOREIGN KEY FK_F6EAAD891FE9DE17');
        $this->addSql('ALTER TABLE routes_point_of_interest DROP FOREIGN KEY FK_A4FD6C6F1FE9DE17');
        $this->addSql('ALTER TABLE region DROP FOREIGN KEY FK_F62F176AE2C16DC');
        $this->addSql('ALTER TABLE routes_point_of_interest DROP FOREIGN KEY FK_A4FD6C6FAE2C16DC');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE coordinates');
        $this->addSql('DROP TABLE point_of_interest');
        $this->addSql('DROP TABLE point_of_interest_category');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE routes');
        $this->addSql('DROP TABLE routes_point_of_interest');
    }
}
