<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170522185339 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE papertype_conference (conference_id INT NOT NULL, paper_type_id INT NOT NULL, INDEX IDX_3159856B604B8382 (conference_id), INDEX IDX_3159856BC5E8DE72 (paper_type_id), PRIMARY KEY(conference_id, paper_type_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE papertype_conference ADD CONSTRAINT FK_3159856B604B8382 FOREIGN KEY (conference_id) REFERENCES conference (id)');
        $this->addSql('ALTER TABLE papertype_conference ADD CONSTRAINT FK_3159856BC5E8DE72 FOREIGN KEY (paper_type_id) REFERENCES paper_type (id)');
        $this->addSql('ALTER TABLE paper CHANGE file_name file_name VARCHAR(200) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE papertype_conference');
        $this->addSql('ALTER TABLE paper CHANGE file_name file_name VARCHAR(200) NOT NULL COLLATE utf8_unicode_ci');
    }
}
