<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241203220603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alojamiento (id INT AUTO_INCREMENT NOT NULL, propietario_id INT DEFAULT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_2691812553C8D32C (propietario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alquiler (id INT AUTO_INCREMENT NOT NULL, cliente_id INT DEFAULT NULL, alojamiento_id INT DEFAULT NULL, INDEX IDX_655BED39DE734E51 (cliente_id), INDEX IDX_655BED39FD574BC5 (alojamiento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nombre_apellidos VARCHAR(255) NOT NULL, propietario TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alojamiento ADD CONSTRAINT FK_2691812553C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE alquiler ADD CONSTRAINT FK_655BED39DE734E51 FOREIGN KEY (cliente_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE alquiler ADD CONSTRAINT FK_655BED39FD574BC5 FOREIGN KEY (alojamiento_id) REFERENCES alojamiento (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alojamiento DROP FOREIGN KEY FK_2691812553C8D32C');
        $this->addSql('ALTER TABLE alquiler DROP FOREIGN KEY FK_655BED39DE734E51');
        $this->addSql('ALTER TABLE alquiler DROP FOREIGN KEY FK_655BED39FD574BC5');
        $this->addSql('DROP TABLE alojamiento');
        $this->addSql('DROP TABLE alquiler');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
