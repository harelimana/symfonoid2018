<?php
/**
 * Created by PhpStorm.
 * User: axxahretz
 * Date: 11.05.18
 * Time: 22:23
 */

namespace App\Services;


use App\Entity\News;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Bundle\MakerBundle\Generator;

/**
 * Class FixturesManager
 * @package App\Services
 */
class FixturesManager
{
    /**
     * @var Generator
     */
    protected $faker;

    /**
     * FixturesManager constructor.
     */
    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * @param int $n
     * @return array
     */
    public function getArticles($n=1){
        $articles = [];
        for($i = 0; $i < $n; $i++){
            $articles[] = $this->getArticle();
        }
        return $articles;
    }

    /**
     * @return array
     */
    public function getArticle() {
        return [
            'title'=>$this->faker->words(rand(3, 7), true),
            'text' => $this->faker->paragraph(3),
            'image' => $this->faker->imageUrl(300, 150)
        ];
    }

    /**
     * @return Generator
     */
    public function getFaker(): Generator {
        return $this->faker;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager){
        $faker = Factory::create('fr-FR');
        for ($i = 0;$i < 3; $i++){
            $news = new News();
            $news->setTitle($faker->title);
            $news->setContent($faker->content);
            $news->setImageUrl($faker->image_url);
            $news->setPublicationDate($faker->publication_date);
            $news->setAuthors($faker->authors);
            $news->setCategories($faker->categories);
        }
        $manager->flush();
    }
}