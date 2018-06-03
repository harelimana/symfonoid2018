<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180603201128 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE news_category (categories_id INT NOT NULL, news_id INT NOT NULL, INDEX IDX_4F72BA90A21214B7 (categories_id), INDEX IDX_4F72BA90B5A459A0 (news_id), PRIMARY KEY(categories_id, news_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE news_category ADD CONSTRAINT FK_4F72BA90A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news_category ADD CONSTRAINT FK_4F72BA90B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A6DE2013A');
        $this->addSql('DROP INDEX UNIQ_E01FBE6A6DE2013A ON images');
        $this->addSql('ALTER TABLE images DROP authors_id');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668B5A459A0');
        $this->addSql('DROP INDEX IDX_3AF34668B5A459A0 ON categories');
        $this->addSql('ALTER TABLE categories DROP news_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE news_category');
        $this->addSql('ALTER TABLE categories ADD news_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id)');
        $this->addSql('CREATE INDEX IDX_3AF34668B5A459A0 ON categories (news_id)');
        $this->addSql('ALTER TABLE images ADD authors_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A6DE2013A FOREIGN KEY (authors_id) REFERENCES authors (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E01FBE6A6DE2013A ON images (authors_id)');
    }
}
