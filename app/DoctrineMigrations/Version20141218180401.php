<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141218180401 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE Level CHANGE levelnumber characterLevel SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE Person ADD gender VARCHAR(64) NOT NULL, ADD race VARCHAR(64) NOT NULL, DROP raceAndGenderCodes');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE Level CHANGE characterlevel levelNumber SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE Person ADD raceAndGenderCodes LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', DROP gender, DROP race');
    }
}
