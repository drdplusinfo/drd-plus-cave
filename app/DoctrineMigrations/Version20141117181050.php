<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141117181050 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE Level (id INT AUTO_INCREMENT NOT NULL, strength_id INT DEFAULT NULL, agility_id INT DEFAULT NULL, knack_id INT DEFAULT NULL, will_id INT DEFAULT NULL, intelligence_id INT DEFAULT NULL, charisma_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_5B2BE317100368EB (strength_id), UNIQUE INDEX UNIQ_5B2BE317CA819DFD (agility_id), UNIQUE INDEX UNIQ_5B2BE3175B37E97E (knack_id), UNIQUE INDEX UNIQ_5B2BE3172F6AA19C (will_id), UNIQUE INDEX UNIQ_5B2BE3177584E372 (intelligence_id), UNIQUE INDEX UNIQ_5B2BE3172D4C4FBA (charisma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE317100368EB FOREIGN KEY (strength_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE317CA819DFD FOREIGN KEY (agility_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE3175B37E97E FOREIGN KEY (knack_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE3172F6AA19C FOREIGN KEY (will_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE3177584E372 FOREIGN KEY (intelligence_id) REFERENCES Property (id)');
        $this->addSql('ALTER TABLE Level ADD CONSTRAINT FK_5B2BE3172D4C4FBA FOREIGN KEY (charisma_id) REFERENCES Property (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('DROP TABLE Level');
    }
}
