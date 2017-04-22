<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Conference;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadConferenceData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $conference = new Conference();
        $conference->setName('Conference_name 1');

        $manager->persist($conference);
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}