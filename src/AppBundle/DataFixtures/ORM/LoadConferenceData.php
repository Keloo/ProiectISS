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
        $startTime = new \DateTime('now');
        $startTime->modify('-1 year');
        $endTime = new \DateTime('now');
        $endTime->modify('-10 months');

        $conference1 = new Conference();
        $conference1
            ->setName('Conference_name 1')
            ->setStartTime($startTime)
            ->setCallForPapersStart($startTime)
            ->setPaperSubmissionStart($startTime)
            ->setEndTime($endTime)
            ->setCallForPapersEnd($endTime)
            ->setPaperSubmissionEnd($endTime);
        $manager->persist($conference1);
        $manager->flush();
        $this->addReference('conference1', $conference1);

        $conference2 = new Conference();
        $conference2
            ->setName('Conference_name 2')
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