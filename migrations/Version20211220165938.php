<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211220165938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient (uuid UUID NOT NULL, name VARCHAR(255) NOT NULL, price_amount INT NOT NULL, price_currency VARCHAR(3) NOT NULL, PRIMARY KEY(uuid))');
        $this->addSql('COMMENT ON COLUMN ingredient.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN ingredient.name IS \'(DC2Type:name)\'');
        $this->addSql('COMMENT ON COLUMN ingredient.price_amount IS \'(DC2Type:amount)\'');
        $this->addSql('COMMENT ON COLUMN ingredient.price_currency IS \'(DC2Type:currency)\'');
        $this->addSql('CREATE TABLE pizza (uuid UUID NOT NULL, name VARCHAR(255) NOT NULL, price_amount INT NOT NULL, price_currency VARCHAR(3) NOT NULL, PRIMARY KEY(uuid))');
        $this->addSql('COMMENT ON COLUMN pizza.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN pizza.name IS \'(DC2Type:name)\'');
        $this->addSql('COMMENT ON COLUMN pizza.price_amount IS \'(DC2Type:amount)\'');
        $this->addSql('COMMENT ON COLUMN pizza.price_currency IS \'(DC2Type:currency)\'');
        $this->addSql('CREATE TABLE pizza_ingredients (pizza_uuid UUID NOT NULL, ingredient_uuid UUID NOT NULL, PRIMARY KEY(pizza_uuid, ingredient_uuid))');
        $this->addSql('CREATE INDEX IDX_AD0714F6195BD373 ON pizza_ingredients (pizza_uuid)');
        $this->addSql('CREATE INDEX IDX_AD0714F68F2EE030 ON pizza_ingredients (ingredient_uuid)');
        $this->addSql('COMMENT ON COLUMN pizza_ingredients.pizza_uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN pizza_ingredients.ingredient_uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE pizza_ingredients ADD CONSTRAINT FK_AD0714F6195BD373 FOREIGN KEY (pizza_uuid) REFERENCES pizza (uuid) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pizza_ingredients ADD CONSTRAINT FK_AD0714F68F2EE030 FOREIGN KEY (ingredient_uuid) REFERENCES ingredient (uuid) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pizza_ingredients DROP CONSTRAINT FK_AD0714F68F2EE030');
        $this->addSql('ALTER TABLE pizza_ingredients DROP CONSTRAINT FK_AD0714F6195BD373');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE pizza');
        $this->addSql('DROP TABLE pizza_ingredients');
    }
}
