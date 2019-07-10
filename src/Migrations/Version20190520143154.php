<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190520143154 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, telephone VARCHAR(11) DEFAULT NULL, email VARCHAR(64) DEFAULT NULL, contact_person VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, id_supplier_id INT DEFAULT NULL, id_sub_category_id INT NOT NULL, name VARCHAR(255) NOT NULL, unit VARCHAR(100) NOT NULL, package VARCHAR(100) DEFAULT NULL, stock NUMERIC(10, 2) DEFAULT NULL, price NUMERIC(10, 2) DEFAULT NULL, due_date DATE DEFAULT NULL, INDEX IDX_D34A04AD32CFA07B (id_supplier_id), INDEX IDX_D34A04AD1EE12BF4 (id_sub_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_category (id INT AUTO_INCREMENT NOT NULL, id_category_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_BCE3F798A545015 (id_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD32CFA07B FOREIGN KEY (id_supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD1EE12BF4 FOREIGN KEY (id_sub_category_id) REFERENCES sub_category (id)');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F798A545015 FOREIGN KEY (id_category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F798A545015');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD32CFA07B');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD1EE12BF4');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE supplier');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE sub_category');
    }
}
