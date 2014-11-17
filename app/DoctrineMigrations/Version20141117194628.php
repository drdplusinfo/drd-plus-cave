<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141117194628 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE Person (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, raceAndGenderCodes LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Property (id INT AUTO_INCREMENT NOT NULL, value INT NOT NULL, code VARCHAR(16) NOT NULL, `label` VARCHAR(255) NOT NULL, shortLabel VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Level (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, levelNumber SMALLINT NOT NULL, fighterLevel_id INT DEFAULT NULL, priestLevel_id INT DEFAULT NULL, rangerLevel_id INT DEFAULT NULL, theurgistLevel_id INT DEFAULT NULL, thiefLevel_id INT DEFAULT NULL, wizardLevel_id INT DEFAULT NULL, strengthIncrement_id INT DEFAULT NULL, agilityIncrement_id INT DEFAULT NULL, knackIncrement_id INT DEFAULT NULL, willIncrement_id INT DEFAULT NULL, intelligenceIncrement_id INT DEFAULT NULL, charismaIncrement_id INT DEFAULT NULL, INDEX IDX_5B2BE317217BBB47 (person_id), UNIQUE INDEX UNIQ_5B2BE317ACC7D7E1 (fighterLevel_id), UNIQUE INDEX UNIQ_5B2BE3176D03574 (priestLevel_id), UNIQUE INDEX UNIQ_5B2BE3179B2DE3A6 (rangerLevel_id), UNIQUE INDEX UNIQ_5B2BE317555B92A6 (theurgistLevel_id), UNIQUE INDEX UNIQ_5B2BE317ABAC2359 (thiefLevel_id), UNIQUE INDEX UNIQ_5B2BE317B88EE30C (wizardLevel_id), UNIQUE INDEX UNIQ_5B2BE317E8C1FAF3 (strengthIncrement_id), UNIQUE INDEX UNIQ_5B2BE3172CBC1FB4 (agilityIncrement_id), UNIQUE INDEX UNIQ_5B2BE317CEE10328 (knackIncrement_id), UNIQUE INDEX UNIQ_5B2BE317F2E8B4BD (willIncrement_id), UNIQUE INDEX UNIQ_5B2BE317952EDD8F (intelligenceIncrement_id), UNIQUE INDEX UNIQ_5B2BE31774FCD56A (charismaIncrement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ThiefLevel (id INT AUTO_INCREMENT NOT NULL, professionLevel INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE RangerLevel (id INT AUTO_INCREMENT NOT NULL, professionLevel INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE FighterLevel (id INT AUTO_INCREMENT NOT NULL, professionLevel INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE TheurgistLevel (id INT AUTO_INCREMENT NOT NULL, professionLevel INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE WizardLevel (id INT AUTO_INCREMENT NOT NULL, professionLevel INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE PriestLevel (id INT AUTO_INCREMENT NOT NULL, professionLevel INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE317217BBB47 FOREIGN KEY (person_id) REFERENCES Person (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE317ACC7D7E1 FOREIGN KEY (fighterLevel_id) REFERENCES FighterLevel (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE3176D03574 FOREIGN KEY (priestLevel_id) REFERENCES PriestLevel (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE3179B2DE3A6 FOREIGN KEY (rangerLevel_id) REFERENCES RangerLevel (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE317555B92A6 FOREIGN KEY (theurgistLevel_id) REFERENCES TheurgistLevel (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE317ABAC2359 FOREIGN KEY (thiefLevel_id) REFERENCES ThiefLevel (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE317B88EE30C FOREIGN KEY (wizardLevel_id) REFERENCES WizardLevel (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE317E8C1FAF3 FOREIGN KEY (strengthIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE3172CBC1FB4 FOREIGN KEY (agilityIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE317CEE10328 FOREIGN KEY (knackIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE317F2E8B4BD FOREIGN KEY (willIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE317952EDD8F FOREIGN KEY (intelligenceIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE31774FCD56A FOREIGN KEY (charismaIncrement_id) REFERENCES Property (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE Level DROP FOREIGN KEY FK_5B2BE317217BBB47');
        $this->addSql('ALTER TABLE Level DROP FOREIGN KEY FK_5B2BE317E8C1FAF3');
        $this->addSql('ALTER TABLE Level DROP FOREIGN KEY FK_5B2BE3172CBC1FB4');
        $this->addSql('ALTER TABLE Level DROP FOREIGN KEY FK_5B2BE317CEE10328');
        $this->addSql('ALTER TABLE Level DROP FOREIGN KEY FK_5B2BE317F2E8B4BD');
        $this->addSql('ALTER TABLE Level DROP FOREIGN KEY FK_5B2BE317952EDD8F');
        $this->addSql('ALTER TABLE Level DROP FOREIGN KEY FK_5B2BE31774FCD56A');
        $this->addSql('ALTER TABLE Level DROP FOREIGN KEY FK_5B2BE317ABAC2359');
        $this->addSql('ALTER TABLE Level DROP FOREIGN KEY FK_5B2BE3179B2DE3A6');
        $this->addSql('ALTER TABLE Level DROP FOREIGN KEY FK_5B2BE317ACC7D7E1');
        $this->addSql('ALTER TABLE Level DROP FOREIGN KEY FK_5B2BE317555B92A6');
        $this->addSql('ALTER TABLE Level DROP FOREIGN KEY FK_5B2BE317B88EE30C');
        $this->addSql('ALTER TABLE Level DROP FOREIGN KEY FK_5B2BE3176D03574');
        $this->addSql('DROP TABLE Person');
        $this->addSql('DROP TABLE Property');
        $this->addSql('DROP TABLE Level');
        $this->addSql('DROP TABLE ThiefLevel');
        $this->addSql('DROP TABLE RangerLevel');
        $this->addSql('DROP TABLE FighterLevel');
        $this->addSql('DROP TABLE TheurgistLevel');
        $this->addSql('DROP TABLE WizardLevel');
        $this->addSql('DROP TABLE PriestLevel');
    }
}
