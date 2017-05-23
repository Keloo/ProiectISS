<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170523034922 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE full_paper (id INT AUTO_INCREMENT NOT NULL, paper_type_id INT DEFAULT NULL, user_id INT DEFAULT NULL, title VARCHAR(200) NOT NULL, description LONGTEXT NOT NULL, file_name VARCHAR(200) NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_3BF52497C5E8DE72 (paper_type_id), INDEX IDX_3BF52497A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE full_paper ADD CONSTRAINT FK_3BF52497C5E8DE72 FOREIGN KEY (paper_type_id) REFERENCES paper_type (id)');
        $this->addSql('ALTER TABLE full_paper ADD CONSTRAINT FK_3BF52497A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE paper CHANGE file_name file_name VARCHAR(200) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE full_paper');
        $this->addSql('ALTER TABLE paper CHANGE file_name file_name VARCHAR(200) NOT NULL COLLATE utf8_unicode_ci');
    }
}
