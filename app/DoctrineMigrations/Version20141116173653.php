<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141116173653 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE Person (id INT AUTO_INCREMENT NOT NULL, fighter_id INT DEFAULT NULL, priest_id INT DEFAULT NULL, ranger_id INT DEFAULT NULL, theurgist_id INT DEFAULT NULL, thief_id INT DEFAULT NULL, wizard_id INT DEFAULT NULL, gender_id INT DEFAULT NULL, strength_id INT DEFAULT NULL, agility_id INT DEFAULT NULL, knack_id INT DEFAULT NULL, will_id INT DEFAULT NULL, intelligence_id INT DEFAULT NULL, charisma_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, raceCode VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3370D44034934341 (fighter_id), UNIQUE INDEX UNIQ_3370D4407DE767BF (priest_id), UNIQUE INDEX UNIQ_3370D440E381DB8A (ranger_id), UNIQUE INDEX UNIQ_3370D44077C449D5 (theurgist_id), UNIQUE INDEX UNIQ_3370D440C0550D3 (thief_id), UNIQUE INDEX UNIQ_3370D44098899D61 (wizard_id), UNIQUE INDEX UNIQ_3370D440708A0E0 (gender_id), UNIQUE INDEX UNIQ_3370D440100368EB (strength_id), UNIQUE INDEX UNIQ_3370D440CA819DFD (agility_id), UNIQUE INDEX UNIQ_3370D4405B37E97E (knack_id), UNIQUE INDEX UNIQ_3370D4402F6AA19C (will_id), UNIQUE INDEX UNIQ_3370D4407584E372 (intelligence_id), UNIQUE INDEX UNIQ_3370D4402D4C4FBA (charisma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Property (id INT AUTO_INCREMENT NOT NULL, value INT NOT NULL, shortLabel VARCHAR(255) NOT NULL, `label` VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Wizard (id INT AUTO_INCREMENT NOT NULL, level SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Priest (id INT AUTO_INCREMENT NOT NULL, level SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Thief (id INT AUTO_INCREMENT NOT NULL, level SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Theurgist (id INT AUTO_INCREMENT NOT NULL, level SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Fighter (id INT AUTO_INCREMENT NOT NULL, level SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Ranger (id INT AUTO_INCREMENT NOT NULL, level SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Gender (id INT AUTO_INCREMENT NOT NULL, genderName VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D44034934341 FOREIGN KEY (fighter_id) REFERENCES Fighter (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D4407DE767BF FOREIGN KEY (priest_id) REFERENCES Priest (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D440E381DB8A FOREIGN KEY (ranger_id) REFERENCES Ranger (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D44077C449D5 FOREIGN KEY (theurgist_id) REFERENCES Theurgist (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D440C0550D3 FOREIGN KEY (thief_id) REFERENCES Thief (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D44098899D61 FOREIGN KEY (wizard_id) REFERENCES Wizard (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D440708A0E0 FOREIGN KEY (gender_id) REFERENCES Gender (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D440100368EB FOREIGN KEY (strength_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D440CA819DFD FOREIGN KEY (agility_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D4405B37E97E FOREIGN KEY (knack_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D4402F6AA19C FOREIGN KEY (will_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D4407584E372 FOREIGN KEY (intelligence_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D4402D4C4FBA FOREIGN KEY (charisma_id) REFERENCES Property (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D440100368EB');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D440CA819DFD');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D4405B37E97E');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D4402F6AA19C');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D4407584E372');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D4402D4C4FBA');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D44098899D61');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D4407DE767BF');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D440C0550D3');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D44077C449D5');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D44034934341');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D440E381DB8A');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D440708A0E0');
        $this->addSql('DROP TABLE Person');
        $this->addSql('DROP TABLE Property');
        $this->addSql('DROP TABLE Wizard');
        $this->addSql('DROP TABLE Priest');
        $this->addSql('DROP TABLE Thief');
        $this->addSql('DROP TABLE Theurgist');
        $this->addSql('DROP TABLE Fighter');
        $this->addSql('DROP TABLE Ranger');
        $this->addSql('DROP TABLE Gender');
    }
}
