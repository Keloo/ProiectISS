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
        $startTime = new \DateTime('2017-05-01');
        $endTime = new \DateTime('2017-06-10');

        $conference1 = new Conference();
        $conference1
            ->setName('Math Conference')
            ->setStartTime($startTime)
            ->setCallForPapersStart($startTime->modify("+20 days"))
            ->setPaperSubmissionStart($startTime)
            ->setEndTime($endTime)
            ->setCallForPapersEnd($endTime->modify("+25 days"))
            ->setPaperSubmissionEnd($endTime);
        $manager->persist($conference1);
        $manager->flush();
        $this->addReference('conference1', $conference1);

        $conference2 = new Conference();
        $conference2
            ->setName('Informatics Conference')
            ->setStartTime($startTime->modify('+5 months'))
            ->setCallForPapersStart($startTime->modify('+5 months'))
            ->setPaperSubmissionStart($startTime->modify('+5 months'))
            ->setEndTime($endTime->modify('+5 months'))
            ->setCallForPapersEnd($endTime->modify('+5 months'))
            ->setPaperSubmissionEnd($endTime->modify('+5 months'));
        $manager->persist($conference2);
        $manager->flush();
        $this->addReference('conference2', $conference2);
    }

    public function getOrder()
    {
        return 1;
    }
}