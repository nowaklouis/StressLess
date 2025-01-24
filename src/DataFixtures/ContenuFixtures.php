<?php

namespace App\DataFixtures;

use App\Entity\Contenu;
use App\Entity\Image;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ContenuFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $types = [
            'Vidéos',
            'Audio',
            'Articles et blogs',
            'Infographies',
            'Interactif',
            'Ressources imprimées ou téléchargeables',
            'Expériences communautaires',
            'Jeux et activités',
            'Contenu visuel sur les réseaux sociaux',
        ];

        $typeEntities = [];
        foreach ($types as $typeName) {
            $type = new Type();
            $type->setName($typeName);
            $manager->persist($type);
            $typeEntities[] = $type;
        }

        for ($i = 0; $i < 30; $i++) {
            $contenu = new Contenu();
            $createdAt = $faker->dateTimeBetween('-2 months', 'now');
            $publishAt = (clone $createdAt)->modify('+1 day');

            $contenu->setTitle($faker->sentence())
                ->setContent($faker->paragraph())
                ->setStatus(true)
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($createdAt))
                ->setPublishAt(\DateTimeImmutable::createFromMutable($publishAt))
                ->setLevel(rand(100, 400))
                ->setType($faker->randomElement($typeEntities));

            $image = new Image();
            $image->setImageName($faker->word . '.jpg');
            $image->setUpdatedAt(new \DateTimeImmutable());
            $image->setContenu($contenu);

            $contenu->setImage($image);

            $manager->persist($contenu);
            $manager->persist($image);
        }

        $manager->flush();
    }
}
