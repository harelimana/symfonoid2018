<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180514213029 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, authors_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, url VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E01FBE6A6DE2013A (authors_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, authors_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, image_url VARCHAR(255) DEFAULT NULL, publication_date DATETIME DEFAULT NULL, INDEX IDX_1DD399506DE2013A (authors_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, news_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, INDEX IDX_3AF34668B5A459A0 (news_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE authors (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, birthday DATETIME NOT NULL, biography VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A6DE2013A FOREIGN KEY (authors_id) REFERENCES authors (id)');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD399506DE2013A FOREIGN KEY (authors_id) REFERENCES authors (id)');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668B5A459A0');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A6DE2013A');
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD399506DE2013A');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE authors');
    }
}
