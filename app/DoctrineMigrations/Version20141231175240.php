<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141231175240 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE InitialProperties (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, initialStrength INT NOT NULL, initialAgility INT NOT NULL, initialKnack INT NOT NULL, initialWill INT NOT NULL, initialIntelligence INT NOT NULL, initialCharisma INT NOT NULL, UNIQUE INDEX UNIQ_6018AB25217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE InitialProperties ADD CONSTRAINT FK_6018AB25217BBB47 FOREIGN KEY (person_id) REFERENCES Person (id)');
        $this->addSql('ALTER TABLE Person ADD initialProperties_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D4401CA4EC24 FOREIGN KEY (initialProperties_id) REFERENCES InitialProperties (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3370D4401CA4EC24 ON Person (initialProperties_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D4401CA4EC24');
        $this->addSql('DROP TABLE InitialProperties');
        $this->addSql('DROP INDEX UNIQ_3370D4401CA4EC24 ON Person');
        $this->addSql('ALTER TABLE Person DROP initialProperties_id');
    }
}
