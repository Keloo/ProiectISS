<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170523161652 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE paper CHANGE file_name file_name VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE full_paper CHANGE file_name file_name VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE paper_evaluation ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paper_evaluation ADD CONSTRAINT FK_E23547C5A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_E23547C5A76ED395 ON paper_evaluation (user_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE full_paper CHANGE file_name file_name VARCHAR(200) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE paper CHANGE file_name file_name VARCHAR(200) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE paper_evaluation DROP FOREIGN KEY FK_E23547C5A76ED395');
        $this->addSql('DROP INDEX IDX_E23547C5A76ED395 ON paper_evaluation');
        $this->addSql('ALTER TABLE paper_evaluation DROP user_id');
    }
}
