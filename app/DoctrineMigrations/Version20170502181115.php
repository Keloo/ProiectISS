<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170502181115 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE conference (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, start_time DATETIME NOT NULL, end_time DATETIME NOT NULL, call_for_papers_start DATETIME NOT NULL, call_for_papers_end DATETIME NOT NULL, paper_submission_start DATETIME NOT NULL, paper_submission_end DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paper_evaluation (id INT AUTO_INCREMENT NOT NULL, paper_id INT DEFAULT NULL, message LONGTEXT NOT NULL, rate INT NOT NULL, INDEX IDX_E23547C5E6758861 (paper_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paper (id INT AUTO_INCREMENT NOT NULL, paper_type_id INT DEFAULT NULL, user_id INT DEFAULT NULL, title VARCHAR(200) NOT NULL, description LONGTEXT NOT NULL, file_name VARCHAR(200) NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_4E1A6016C5E8DE72 (paper_type_id), INDEX IDX_4E1A6016A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', first_name VARCHAR(200) NOT NULL, last_name VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_conferences (user_id INT NOT NULL, conference_id INT NOT NULL, INDEX IDX_7995AC48A76ED395 (user_id), INDEX IDX_7995AC48604B8382 (conference_id), PRIMARY KEY(user_id, conference_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paper_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE paper_evaluation ADD CONSTRAINT FK_E23547C5E6758861 FOREIGN KEY (paper_id) REFERENCES paper (id)');
        $this->addSql('ALTER TABLE paper ADD CONSTRAINT FK_4E1A6016C5E8DE72 FOREIGN KEY (paper_type_id) REFERENCES paper_type (id)');
        $this->addSql('ALTER TABLE paper ADD CONSTRAINT FK_4E1A6016A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE users_conferences ADD CONSTRAINT FK_7995AC48A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE users_conferences ADD CONSTRAINT FK_7995AC48604B8382 FOREIGN KEY (conference_id) REFERENCES conference (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users_conferences DROP FOREIGN KEY FK_7995AC48604B8382');
        $this->addSql('ALTER TABLE paper_evaluation DROP FOREIGN KEY FK_E23547C5E6758861');
        $this->addSql('ALTER TABLE paper DROP FOREIGN KEY FK_4E1A6016A76ED395');
        $this->addSql('ALTER TABLE users_conferences DROP FOREIGN KEY FK_7995AC48A76ED395');
        $this->addSql('ALTER TABLE paper DROP FOREIGN KEY FK_4E1A6016C5E8DE72');
        $this->addSql('DROP TABLE conference');
        $this->addSql('DROP TABLE paper_evaluation');
        $this->addSql('DROP TABLE paper');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE users_conferences');
        $this->addSql('DROP TABLE paper_type');
    }
}
