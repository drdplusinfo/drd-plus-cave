<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141117180718 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D440100368EB');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D4402D4C4FBA');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D4402F6AA19C');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D4405B37E97E');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D4407584E372');
        $this->addSql('ALTER TABLE Person DROP FOREIGN KEY FK_3370D440CA819DFD');
        $this->addSql('DROP INDEX UNIQ_3370D440100368EB ON Person');
        $this->addSql('DROP INDEX UNIQ_3370D440CA819DFD ON Person');
        $this->addSql('DROP INDEX UNIQ_3370D4405B37E97E ON Person');
        $this->addSql('DROP INDEX UNIQ_3370D4402F6AA19C ON Person');
        $this->addSql('DROP INDEX UNIQ_3370D4407584E372 ON Person');
        $this->addSql('DROP INDEX UNIQ_3370D4402D4C4FBA ON Person');
        $this->addSql('ALTER TABLE Person DROP strength_id, DROP charisma_id, DROP will_id, DROP knack_id, DROP intelligence_id, DROP agility_id');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE Person ADD strength_id INT DEFAULT NULL, ADD charisma_id INT DEFAULT NULL, ADD will_id INT DEFAULT NULL, ADD knack_id INT DEFAULT NULL, ADD intelligence_id INT DEFAULT NULL, ADD agility_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D440100368EB FOREIGN KEY (strength_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D4402D4C4FBA FOREIGN KEY (charisma_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D4402F6AA19C FOREIGN KEY (will_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D4405B37E97E FOREIGN KEY (knack_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D4407584E372 FOREIGN KEY (intelligence_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Person ADD CONSTRAINT FK_3370D440CA819DFD FOREIGN KEY (agility_id) REFERENCES Property (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3370D440100368EB ON Person (strength_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3370D440CA819DFD ON Person (agility_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3370D4405B37E97E ON Person (knack_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3370D4402F6AA19C ON Person (will_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3370D4407584E372 ON Person (intelligence_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3370D4402D4C4FBA ON Person (charisma_id)');
    }
}
