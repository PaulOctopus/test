<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181128183620 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_field (id INT AUTO_INCREMENT NOT NULL, field_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_field_value (id INT AUTO_INCREMENT NOT NULL, field_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_9FCB075A443707B0 (field_id), INDEX IDX_9FCB075AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_field_value ADD CONSTRAINT FK_9FCB075A443707B0 FOREIGN KEY (field_id) REFERENCES user_field (id)');
        $this->addSql('ALTER TABLE user_field_value ADD CONSTRAINT FK_9FCB075AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_field_value DROP FOREIGN KEY FK_9FCB075AA76ED395');
        $this->addSql('ALTER TABLE user_field_value DROP FOREIGN KEY FK_9FCB075A443707B0');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_field');
        $this->addSql('DROP TABLE user_field_value');
    }
}
