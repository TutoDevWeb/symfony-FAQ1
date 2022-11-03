<?php

namespace App\DataFixtures;

use App\Entity\QR;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 10; $i++) {
            $qr = new QR();
            $qr->setQuestion("Question numéro $i de cette Faq");
            $qr->setReponse("Reponse numéro $i de cette Faq");
            $manager->persist($qr);
        }

        $manager->flush();
    }
}
