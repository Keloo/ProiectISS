<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\PaperType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadPaperTypeData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $pt1 = new PaperType();
        $pt1->setName('Diferential Equations');
        $manager->persist($pt1);
        $manager->flush();
        $this->addReference('paper-type-1', $pt1);

        $pt2 = new PaperType();
        $pt2->setName('Functional Analysis');
        $manager->persist($pt2);
        $manager->flush();
        $this->addReference('paper-type-2', $pt2);

        $pt3 = new PaperType();
        $pt3->setName('Algorithms');
        $manager->persist($pt3);
        $manager->flush();
        $this->addReference('paper-type-3', $pt3);

        $pt4 = new PaperType();
        $pt4->setName('Information Security');
        $manager->persist($pt4);
        $manager->flush();
        $this->addReference('paper-type-4', $pt4);

    }

    public function getOrder()
    {
        return 1;
    }
}