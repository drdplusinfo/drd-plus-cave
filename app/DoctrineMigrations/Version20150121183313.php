<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150121183313 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE ThiefLevel DROP FOREIGN KEY FK_E1404D6774FCD56A');
        $this->addSql('ALTER TABLE ThiefLevel DROP FOREIGN KEY FK_E1404D672CBC1FB4');
        $this->addSql('ALTER TABLE ThiefLevel DROP FOREIGN KEY FK_E1404D67952EDD8F');
        $this->addSql('ALTER TABLE ThiefLevel DROP FOREIGN KEY FK_E1404D67CEE10328');
        $this->addSql('ALTER TABLE ThiefLevel DROP FOREIGN KEY FK_E1404D67E8C1FAF3');
        $this->addSql('ALTER TABLE ThiefLevel DROP FOREIGN KEY FK_E1404D67F2E8B4BD');
        $this->addSql('DROP INDEX UNIQ_E1404D67E8C1FAF3 ON ThiefLevel');
        $this->addSql('DROP INDEX UNIQ_E1404D672CBC1FB4 ON ThiefLevel');
        $this->addSql('DROP INDEX UNIQ_E1404D67CEE10328 ON ThiefLevel');
        $this->addSql('DROP INDEX UNIQ_E1404D67F2E8B4BD ON ThiefLevel');
        $this->addSql('DROP INDEX UNIQ_E1404D67952EDD8F ON ThiefLevel');
        $this->addSql('DROP INDEX UNIQ_E1404D6774FCD56A ON ThiefLevel');
        $this->addSql('ALTER TABLE ThiefLevel ADD professionLevels_id INT DEFAULT NULL, DROP professionLevel, DROP level, DROP levelUpAt, DROP strengthIncrement_id, DROP agilityIncrement_id, DROP knackIncrement_id, DROP willIncrement_id, DROP intelligenceIncrement_id, DROP charismaIncrement_id');
        $this->addSql('ALTER TABLE ThiefLevel ADD CONSTRAINT FK_E1404D6723D9C61A FOREIGN KEY (professionLevels_id) REFERENCES ProfessionLevels (id)');
        $this->addSql('CREATE INDEX IDX_E1404D6723D9C61A ON ThiefLevel (professionLevels_id)');
        $this->addSql('ALTER TABLE RangerLevel DROP FOREIGN KEY FK_3992925174FCD56A');
        $this->addSql('ALTER TABLE RangerLevel DROP FOREIGN KEY FK_399292512CBC1FB4');
        $this->addSql('ALTER TABLE RangerLevel DROP FOREIGN KEY FK_39929251952EDD8F');
        $this->addSql('ALTER TABLE RangerLevel DROP FOREIGN KEY FK_39929251CEE10328');
        $this->addSql('ALTER TABLE RangerLevel DROP FOREIGN KEY FK_39929251E8C1FAF3');
        $this->addSql('ALTER TABLE RangerLevel DROP FOREIGN KEY FK_39929251F2E8B4BD');
        $this->addSql('DROP INDEX UNIQ_39929251E8C1FAF3 ON RangerLevel');
        $this->addSql('DROP INDEX UNIQ_399292512CBC1FB4 ON RangerLevel');
        $this->addSql('DROP INDEX UNIQ_39929251CEE10328 ON RangerLevel');
        $this->addSql('DROP INDEX UNIQ_39929251F2E8B4BD ON RangerLevel');
        $this->addSql('DROP INDEX UNIQ_39929251952EDD8F ON RangerLevel');
        $this->addSql('DROP INDEX UNIQ_3992925174FCD56A ON RangerLevel');
        $this->addSql('ALTER TABLE RangerLevel ADD professionLevels_id INT DEFAULT NULL, DROP professionLevel, DROP level, DROP levelUpAt, DROP strengthIncrement_id, DROP agilityIncrement_id, DROP knackIncrement_id, DROP willIncrement_id, DROP intelligenceIncrement_id, DROP charismaIncrement_id');
        $this->addSql('ALTER TABLE RangerLevel ADD CONSTRAINT FK_3992925123D9C61A FOREIGN KEY (professionLevels_id) REFERENCES ProfessionLevels (id)');
        $this->addSql('CREATE INDEX IDX_3992925123D9C61A ON RangerLevel (professionLevels_id)');
        $this->addSql('ALTER TABLE FighterLevel DROP FOREIGN KEY FK_71E5049F74FCD56A');
        $this->addSql('ALTER TABLE FighterLevel DROP FOREIGN KEY FK_71E5049F2CBC1FB4');
        $this->addSql('ALTER TABLE FighterLevel DROP FOREIGN KEY FK_71E5049F952EDD8F');
        $this->addSql('ALTER TABLE FighterLevel DROP FOREIGN KEY FK_71E5049FCEE10328');
        $this->addSql('ALTER TABLE FighterLevel DROP FOREIGN KEY FK_71E5049FE8C1FAF3');
        $this->addSql('ALTER TABLE FighterLevel DROP FOREIGN KEY FK_71E5049FF2E8B4BD');
        $this->addSql('DROP INDEX UNIQ_71E5049FE8C1FAF3 ON FighterLevel');
        $this->addSql('DROP INDEX UNIQ_71E5049F2CBC1FB4 ON FighterLevel');
        $this->addSql('DROP INDEX UNIQ_71E5049FCEE10328 ON FighterLevel');
        $this->addSql('DROP INDEX UNIQ_71E5049FF2E8B4BD ON FighterLevel');
        $this->addSql('DROP INDEX UNIQ_71E5049F952EDD8F ON FighterLevel');
        $this->addSql('DROP INDEX UNIQ_71E5049F74FCD56A ON FighterLevel');
        $this->addSql('ALTER TABLE FighterLevel DROP level, DROP levelUpAt, DROP strengthIncrement_id, DROP agilityIncrement_id, DROP knackIncrement_id, DROP willIncrement_id, DROP intelligenceIncrement_id, DROP charismaIncrement_id');
        $this->addSql('ALTER TABLE TheurgistLevel DROP FOREIGN KEY FK_514842E874FCD56A');
        $this->addSql('ALTER TABLE TheurgistLevel DROP FOREIGN KEY FK_514842E82CBC1FB4');
        $this->addSql('ALTER TABLE TheurgistLevel DROP FOREIGN KEY FK_514842E8952EDD8F');
        $this->addSql('ALTER TABLE TheurgistLevel DROP FOREIGN KEY FK_514842E8CEE10328');
        $this->addSql('ALTER TABLE TheurgistLevel DROP FOREIGN KEY FK_514842E8E8C1FAF3');
        $this->addSql('ALTER TABLE TheurgistLevel DROP FOREIGN KEY FK_514842E8F2E8B4BD');
        $this->addSql('DROP INDEX UNIQ_514842E8E8C1FAF3 ON TheurgistLevel');
        $this->addSql('DROP INDEX UNIQ_514842E82CBC1FB4 ON TheurgistLevel');
        $this->addSql('DROP INDEX UNIQ_514842E8CEE10328 ON TheurgistLevel');
        $this->addSql('DROP INDEX UNIQ_514842E8F2E8B4BD ON TheurgistLevel');
        $this->addSql('DROP INDEX UNIQ_514842E8952EDD8F ON TheurgistLevel');
        $this->addSql('DROP INDEX UNIQ_514842E874FCD56A ON TheurgistLevel');
        $this->addSql('ALTER TABLE TheurgistLevel ADD professionLevels_id INT DEFAULT NULL, DROP professionLevel, DROP level, DROP levelUpAt, DROP strengthIncrement_id, DROP agilityIncrement_id, DROP knackIncrement_id, DROP willIncrement_id, DROP intelligenceIncrement_id, DROP charismaIncrement_id');
        $this->addSql('ALTER TABLE TheurgistLevel ADD CONSTRAINT FK_514842E823D9C61A FOREIGN KEY (professionLevels_id) REFERENCES ProfessionLevels (id)');
        $this->addSql('CREATE INDEX IDX_514842E823D9C61A ON TheurgistLevel (professionLevels_id)');
        $this->addSql('ALTER TABLE WizardLevel DROP FOREIGN KEY FK_1BA727DB74FCD56A');
        $this->addSql('ALTER TABLE WizardLevel DROP FOREIGN KEY FK_1BA727DB2CBC1FB4');
        $this->addSql('ALTER TABLE WizardLevel DROP FOREIGN KEY FK_1BA727DB952EDD8F');
        $this->addSql('ALTER TABLE WizardLevel DROP FOREIGN KEY FK_1BA727DBCEE10328');
        $this->addSql('ALTER TABLE WizardLevel DROP FOREIGN KEY FK_1BA727DBE8C1FAF3');
        $this->addSql('ALTER TABLE WizardLevel DROP FOREIGN KEY FK_1BA727DBF2E8B4BD');
        $this->addSql('DROP INDEX UNIQ_1BA727DBE8C1FAF3 ON WizardLevel');
        $this->addSql('DROP INDEX UNIQ_1BA727DB2CBC1FB4 ON WizardLevel');
        $this->addSql('DROP INDEX UNIQ_1BA727DBCEE10328 ON WizardLevel');
        $this->addSql('DROP INDEX UNIQ_1BA727DBF2E8B4BD ON WizardLevel');
        $this->addSql('DROP INDEX UNIQ_1BA727DB952EDD8F ON WizardLevel');
        $this->addSql('DROP INDEX UNIQ_1BA727DB74FCD56A ON WizardLevel');
        $this->addSql('ALTER TABLE WizardLevel ADD professionLevels_id INT DEFAULT NULL, DROP professionLevel, DROP level, DROP levelUpAt, DROP strengthIncrement_id, DROP agilityIncrement_id, DROP knackIncrement_id, DROP willIncrement_id, DROP intelligenceIncrement_id, DROP charismaIncrement_id');
        $this->addSql('ALTER TABLE WizardLevel ADD CONSTRAINT FK_1BA727DB23D9C61A FOREIGN KEY (professionLevels_id) REFERENCES ProfessionLevels (id)');
        $this->addSql('CREATE INDEX IDX_1BA727DB23D9C61A ON WizardLevel (professionLevels_id)');
        $this->addSql('ALTER TABLE PriestLevel DROP FOREIGN KEY FK_5974312674FCD56A');
        $this->addSql('ALTER TABLE PriestLevel DROP FOREIGN KEY FK_597431262CBC1FB4');
        $this->addSql('ALTER TABLE PriestLevel DROP FOREIGN KEY FK_59743126952EDD8F');
        $this->addSql('ALTER TABLE PriestLevel DROP FOREIGN KEY FK_59743126CEE10328');
        $this->addSql('ALTER TABLE PriestLevel DROP FOREIGN KEY FK_59743126E8C1FAF3');
        $this->addSql('ALTER TABLE PriestLevel DROP FOREIGN KEY FK_59743126F2E8B4BD');
        $this->addSql('DROP INDEX UNIQ_59743126E8C1FAF3 ON PriestLevel');
        $this->addSql('DROP INDEX UNIQ_597431262CBC1FB4 ON PriestLevel');
        $this->addSql('DROP INDEX UNIQ_59743126CEE10328 ON PriestLevel');
        $this->addSql('DROP INDEX UNIQ_59743126F2E8B4BD ON PriestLevel');
        $this->addSql('DROP INDEX UNIQ_59743126952EDD8F ON PriestLevel');
        $this->addSql('DROP INDEX UNIQ_5974312674FCD56A ON PriestLevel');
        $this->addSql('ALTER TABLE PriestLevel ADD professionLevels_id INT DEFAULT NULL, DROP professionLevel, DROP level, DROP levelUpAt, DROP strengthIncrement_id, DROP agilityIncrement_id, DROP knackIncrement_id, DROP willIncrement_id, DROP intelligenceIncrement_id, DROP charismaIncrement_id');
        $this->addSql('ALTER TABLE PriestLevel ADD CONSTRAINT FK_5974312623D9C61A FOREIGN KEY (professionLevels_id) REFERENCES ProfessionLevels (id)');
        $this->addSql('CREATE INDEX IDX_5974312623D9C61A ON PriestLevel (professionLevels_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE FighterLevel ADD level INT NOT NULL, ADD levelUpAt DATETIME NOT NULL, ADD strengthIncrement_id INT DEFAULT NULL, ADD agilityIncrement_id INT DEFAULT NULL, ADD knackIncrement_id INT DEFAULT NULL, ADD willIncrement_id INT DEFAULT NULL, ADD intelligenceIncrement_id INT DEFAULT NULL, ADD charismaIncrement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE FighterLevel ADD CONSTRAINT FK_71E5049F74FCD56A FOREIGN KEY (charismaIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE FighterLevel ADD CONSTRAINT FK_71E5049F2CBC1FB4 FOREIGN KEY (agilityIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE FighterLevel ADD CONSTRAINT FK_71E5049F952EDD8F FOREIGN KEY (intelligenceIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE FighterLevel ADD CONSTRAINT FK_71E5049FCEE10328 FOREIGN KEY (knackIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE FighterLevel ADD CONSTRAINT FK_71E5049FE8C1FAF3 FOREIGN KEY (strengthIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE FighterLevel ADD CONSTRAINT FK_71E5049FF2E8B4BD FOREIGN KEY (willIncrement_id) REFERENCES Property (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_71E5049FE8C1FAF3 ON FighterLevel (strengthIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_71E5049F2CBC1FB4 ON FighterLevel (agilityIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_71E5049FCEE10328 ON FighterLevel (knackIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_71E5049FF2E8B4BD ON FighterLevel (willIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_71E5049F952EDD8F ON FighterLevel (intelligenceIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_71E5049F74FCD56A ON FighterLevel (charismaIncrement_id)');
        $this->addSql('ALTER TABLE PriestLevel DROP FOREIGN KEY FK_5974312623D9C61A');
        $this->addSql('DROP INDEX IDX_5974312623D9C61A ON PriestLevel');
        $this->addSql('ALTER TABLE PriestLevel ADD professionLevel INT NOT NULL, ADD level INT NOT NULL, ADD levelUpAt DATETIME NOT NULL, ADD agilityIncrement_id INT DEFAULT NULL, ADD knackIncrement_id INT DEFAULT NULL, ADD willIncrement_id INT DEFAULT NULL, ADD intelligenceIncrement_id INT DEFAULT NULL, ADD charismaIncrement_id INT DEFAULT NULL, CHANGE professionlevels_id strengthIncrement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE PriestLevel ADD CONSTRAINT FK_5974312674FCD56A FOREIGN KEY (charismaIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE PriestLevel ADD CONSTRAINT FK_597431262CBC1FB4 FOREIGN KEY (agilityIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE PriestLevel ADD CONSTRAINT FK_59743126952EDD8F FOREIGN KEY (intelligenceIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE PriestLevel ADD CONSTRAINT FK_59743126CEE10328 FOREIGN KEY (knackIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE PriestLevel ADD CONSTRAINT FK_59743126E8C1FAF3 FOREIGN KEY (strengthIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE PriestLevel ADD CONSTRAINT FK_59743126F2E8B4BD FOREIGN KEY (willIncrement_id) REFERENCES Property (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_59743126E8C1FAF3 ON PriestLevel (strengthIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_597431262CBC1FB4 ON PriestLevel (agilityIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_59743126CEE10328 ON PriestLevel (knackIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_59743126F2E8B4BD ON PriestLevel (willIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_59743126952EDD8F ON PriestLevel (intelligenceIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5974312674FCD56A ON PriestLevel (charismaIncrement_id)');
        $this->addSql('ALTER TABLE RangerLevel DROP FOREIGN KEY FK_3992925123D9C61A');
        $this->addSql('DROP INDEX IDX_3992925123D9C61A ON RangerLevel');
        $this->addSql('ALTER TABLE RangerLevel ADD professionLevel INT NOT NULL, ADD level INT NOT NULL, ADD levelUpAt DATETIME NOT NULL, ADD agilityIncrement_id INT DEFAULT NULL, ADD knackIncrement_id INT DEFAULT NULL, ADD willIncrement_id INT DEFAULT NULL, ADD intelligenceIncrement_id INT DEFAULT NULL, ADD charismaIncrement_id INT DEFAULT NULL, CHANGE professionlevels_id strengthIncrement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE RangerLevel ADD CONSTRAINT FK_3992925174FCD56A FOREIGN KEY (charismaIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE RangerLevel ADD CONSTRAINT FK_399292512CBC1FB4 FOREIGN KEY (agilityIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE RangerLevel ADD CONSTRAINT FK_39929251952EDD8F FOREIGN KEY (intelligenceIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE RangerLevel ADD CONSTRAINT FK_39929251CEE10328 FOREIGN KEY (knackIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE RangerLevel ADD CONSTRAINT FK_39929251E8C1FAF3 FOREIGN KEY (strengthIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE RangerLevel ADD CONSTRAINT FK_39929251F2E8B4BD FOREIGN KEY (willIncrement_id) REFERENCES Property (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_39929251E8C1FAF3 ON RangerLevel (strengthIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_399292512CBC1FB4 ON RangerLevel (agilityIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_39929251CEE10328 ON RangerLevel (knackIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_39929251F2E8B4BD ON RangerLevel (willIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_39929251952EDD8F ON RangerLevel (intelligenceIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3992925174FCD56A ON RangerLevel (charismaIncrement_id)');
        $this->addSql('ALTER TABLE TheurgistLevel DROP FOREIGN KEY FK_514842E823D9C61A');
        $this->addSql('DROP INDEX IDX_514842E823D9C61A ON TheurgistLevel');
        $this->addSql('ALTER TABLE TheurgistLevel ADD professionLevel INT NOT NULL, ADD level INT NOT NULL, ADD levelUpAt DATETIME NOT NULL, ADD agilityIncrement_id INT DEFAULT NULL, ADD knackIncrement_id INT DEFAULT NULL, ADD willIncrement_id INT DEFAULT NULL, ADD intelligenceIncrement_id INT DEFAULT NULL, ADD charismaIncrement_id INT DEFAULT NULL, CHANGE professionlevels_id strengthIncrement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE TheurgistLevel ADD CONSTRAINT FK_514842E874FCD56A FOREIGN KEY (charismaIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE TheurgistLevel ADD CONSTRAINT FK_514842E82CBC1FB4 FOREIGN KEY (agilityIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE TheurgistLevel ADD CONSTRAINT FK_514842E8952EDD8F FOREIGN KEY (intelligenceIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE TheurgistLevel ADD CONSTRAINT FK_514842E8CEE10328 FOREIGN KEY (knackIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE TheurgistLevel ADD CONSTRAINT FK_514842E8E8C1FAF3 FOREIGN KEY (strengthIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE TheurgistLevel ADD CONSTRAINT FK_514842E8F2E8B4BD FOREIGN KEY (willIncrement_id) REFERENCES Property (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_514842E8E8C1FAF3 ON TheurgistLevel (strengthIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_514842E82CBC1FB4 ON TheurgistLevel (agilityIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_514842E8CEE10328 ON TheurgistLevel (knackIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_514842E8F2E8B4BD ON TheurgistLevel (willIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_514842E8952EDD8F ON TheurgistLevel (intelligenceIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_514842E874FCD56A ON TheurgistLevel (charismaIncrement_id)');
        $this->addSql('ALTER TABLE ThiefLevel DROP FOREIGN KEY FK_E1404D6723D9C61A');
        $this->addSql('DROP INDEX IDX_E1404D6723D9C61A ON ThiefLevel');
        $this->addSql('ALTER TABLE ThiefLevel ADD professionLevel INT NOT NULL, ADD level INT NOT NULL, ADD levelUpAt DATETIME NOT NULL, ADD agilityIncrement_id INT DEFAULT NULL, ADD knackIncrement_id INT DEFAULT NULL, ADD willIncrement_id INT DEFAULT NULL, ADD intelligenceIncrement_id INT DEFAULT NULL, ADD charismaIncrement_id INT DEFAULT NULL, CHANGE professionlevels_id strengthIncrement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ThiefLevel ADD CONSTRAINT FK_E1404D6774FCD56A FOREIGN KEY (charismaIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE ThiefLevel ADD CONSTRAINT FK_E1404D672CBC1FB4 FOREIGN KEY (agilityIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE ThiefLevel ADD CONSTRAINT FK_E1404D67952EDD8F FOREIGN KEY (intelligenceIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE ThiefLevel ADD CONSTRAINT FK_E1404D67CEE10328 FOREIGN KEY (knackIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE ThiefLevel ADD CONSTRAINT FK_E1404D67E8C1FAF3 FOREIGN KEY (strengthIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE ThiefLevel ADD CONSTRAINT FK_E1404D67F2E8B4BD FOREIGN KEY (willIncrement_id) REFERENCES Property (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1404D67E8C1FAF3 ON ThiefLevel (strengthIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1404D672CBC1FB4 ON ThiefLevel (agilityIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1404D67CEE10328 ON ThiefLevel (knackIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1404D67F2E8B4BD ON ThiefLevel (willIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1404D67952EDD8F ON ThiefLevel (intelligenceIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1404D6774FCD56A ON ThiefLevel (charismaIncrement_id)');
        $this->addSql('ALTER TABLE WizardLevel DROP FOREIGN KEY FK_1BA727DB23D9C61A');
        $this->addSql('DROP INDEX IDX_1BA727DB23D9C61A ON WizardLevel');
        $this->addSql('ALTER TABLE WizardLevel ADD professionLevel INT NOT NULL, ADD level INT NOT NULL, ADD levelUpAt DATETIME NOT NULL, ADD agilityIncrement_id INT DEFAULT NULL, ADD knackIncrement_id INT DEFAULT NULL, ADD willIncrement_id INT DEFAULT NULL, ADD intelligenceIncrement_id INT DEFAULT NULL, ADD charismaIncrement_id INT DEFAULT NULL, CHANGE professionlevels_id strengthIncrement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE WizardLevel ADD CONSTRAINT FK_1BA727DB74FCD56A FOREIGN KEY (charismaIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE WizardLevel ADD CONSTRAINT FK_1BA727DB2CBC1FB4 FOREIGN KEY (agilityIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE WizardLevel ADD CONSTRAINT FK_1BA727DB952EDD8F FOREIGN KEY (intelligenceIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE WizardLevel ADD CONSTRAINT FK_1BA727DBCEE10328 FOREIGN KEY (knackIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE WizardLevel ADD CONSTRAINT FK_1BA727DBE8C1FAF3 FOREIGN KEY (strengthIncrement_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE WizardLevel ADD CONSTRAINT FK_1BA727DBF2E8B4BD FOREIGN KEY (willIncrement_id) REFERENCES Property (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1BA727DBE8C1FAF3 ON WizardLevel (strengthIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1BA727DB2CBC1FB4 ON WizardLevel (agilityIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1BA727DBCEE10328 ON WizardLevel (knackIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1BA727DBF2E8B4BD ON WizardLevel (willIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1BA727DB952EDD8F ON WizardLevel (intelligenceIncrement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1BA727DB74FCD56A ON WizardLevel (charismaIncrement_id)');
    }
}
