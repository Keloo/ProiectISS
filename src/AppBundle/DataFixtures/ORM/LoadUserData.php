<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin
            ->setUsername('admin')
            ->setEmail('admin@example.com')
            ->setPassword('admin')
            ->setFirstName('Super')
            ->setLastName('Admin')
            ->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($userAdmin);
        $manager->flush();
        $this->addReference('admin-user', $userAdmin);

        $user = new User();
        $user
            ->setUsername('user')
            ->setEmail('user@example.com')
            ->setFirstName('user_first')
            ->setLastName('user_last')
            ->setPassword('user')
            ->setRoles(['ROLE_USER'])
            ->addConference($this->getReference('conference1'));
        $manager->persist($user);
        $manager->flush();
        $this->addReference('user-user', $user);

        $reviewer = new User();
        $reviewer
            ->setUsername('reviewer')
            ->setEmail('reviewer@example.com')
            ->setPassword('reviewer')
            ->setFirstName('reviewer_first')
            ->setLastName('reviewer_last')
            ->setRoles(['ROLE_REVIEWER'])
            ->addConference($this->getReference('conference1'));
        $manager->persist($reviewer);
        $manager->flush();
        $this->addReference('reviewer-user', $reviewer);

        $listener = new User();
        $listener
            ->setUsername('listener')
            ->setEmail('listener@example.com')
            ->setPassword('listener')
            ->setFirstName('listener_first')
            ->setLastName('listener_last')
            ->setRoles(['ROLE_LISTENER'])
            ->addConference($this->getReference('conference1'));
        $manager->persist($listener);
        $manager->flush();
        $this->addReference('listener-user', $listener);

        $speaker = new User();
        $speaker
            ->setUsername('speaker')
            ->setEmail('speaker@example.com')
            ->setPassword('speaker')
            ->setFirstName('speaker_first')
            ->setLastName('speaker_last')
            ->setRoles(['ROLE_SPEAKER'])
            ->addConference($this->getReference('conference1'));
        $manager->persist($speaker);
        $manager->flush();
        $this->addReference('speaker-user', $speaker);

        $pc = new User();
        $pc
            ->setUsername('pc')
            ->setEmail('pc@example.com')
            ->setPassword('pc')
            ->setFirstName('pc_first')
            ->setLastName('pc_last')
            ->setRoles(['ROLE_PC'])
            ->addConference($this->getReference('conference1'));
        $manager->persist($pc);
        $manager->flush();
        $this->addReference('pc-user', $pc);
    }

    public function getOrder()
    {
        return 2;
    }
}