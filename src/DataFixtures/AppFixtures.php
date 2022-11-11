<?php

namespace App\DataFixtures;

use App\Entity\Memo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $memo = new Memo();
            $memo->setQuestion("Question numéro $i ?");
            $memo->setReponse("Réponse numéro $i !");
            $memo->setARevoir(false);
            $memo->setDone(false);
            $manager->persist($memo);
        }

        $manager->flush();
    }
}
