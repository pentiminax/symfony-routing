<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Enum\ArticleStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class ArticleFixtures extends Fixture
{
    public function __construct(
        private readonly SluggerInterface $slugger
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $firstTitle = 'Mon premier article';
        $secondTitle = 'Un deuxième article';

        $article = new Article($firstTitle, $this->slugger->slug($firstTitle), ArticleStatusEnum::DRAFT);
        $manager->persist($article);

        $article = new Article($secondTitle, $this->slugger->slug($secondTitle), ArticleStatusEnum::PUBLISHED);
        $manager->persist($article);

        $manager->flush();
    }
}
