<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141116210542 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D440708A0E0');
        $this->addSql('DROP TABLE Gender');
        $this->addSql('DROP INDEX UNIQ_3370D440708A0E0 ON Person');
        $this->addSql('ALTER TABLE Person ADD genderCode VARCHAR(5) NOT NULL, DROP gender_id, CHANGE raceCode raceCode VARCHAR(16) NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE Gender (id INT AUTO_INCREMENT NOT NULL, genderName VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Person ADD gender_id INT DEFAULT NULL, DROP genderCode, CHANGE raceCode raceCode VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D440708A0E0 FOREIGN KEY (gender_id) REFERENCES Gender (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3370D440708A0E0 ON Person (gender_id)');
    }
}
