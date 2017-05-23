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
        $callForPapersStart = new \DateTime('2017-05-20');
        $callForPapersEnd = new \DateTime('2017-06-01');
        $paperSubmissionStart = new \DateTime('2017-06-01');
        $paperSubmissionEnd = new \DateTime('2017-06-10');

        $conference1 = new Conference();
        $conference1
            ->setName('Math Conference')
            ->setStartTime($startTime)
            ->setCallForPapersStart($callForPapersStart)
            ->setPaperSubmissionStart($paperSubmissionStart)
            ->setEndTime($endTime)
            ->setCallForPapersEnd($callForPapersEnd)
            ->setPaperSubmissionEnd($paperSubmissionEnd);
        $manager->persist($conference1);
        $manager->flush();
        $this->addReference('conference1', $conference1);


        $startTime = new \DateTime('2017-05-01');
        $endTime = new \DateTime('2017-06-10');
        $callForPapersStart = new \DateTime('2017-05-10');
        $callForPapersEnd = new \DateTime('2017-05-20');
        $paperSubmissionStart = new \DateTime('2017-05-20');
        $paperSubmissionEnd = new \DateTime('2017-06-10');

        $conference2 = new Conference();
        $conference2
            ->setName('Informatics Conference')
            ->setStartTime($startTime)
            ->setCallForPapersStart($callForPapersStart)
            ->setPaperSubmissionStart($paperSubmissionStart)
            ->setEndTime($endTime)
            ->setCallForPapersEnd($callForPapersEnd)
            ->setPaperSubmissionEnd($paperSubmissionEnd);
        $manager->persist($conference2);
        $manager->flush();
        $this->addReference('conference2', $conference2);
    }

    public function getOrder()
    {
        return 1;
    }
}