<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240919172245 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE "article_categories" (id UUID NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE article_articles ALTER id TYPE UUID');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE "article_categories"');
        $this->addSql('ALTER TABLE "article_articles" ALTER id TYPE UUID');
    }
}
