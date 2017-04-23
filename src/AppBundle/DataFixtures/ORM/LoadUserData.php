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
            ->setEnabled(true)
            ->setEmail('admin@example.com')
            ->setPlainPassword('admin')
            ->setFirstName('Super')
            ->setLastName('Admin')
            ->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($userAdmin);
        $manager->flush();
        $this->addReference('admin-user', $userAdmin);

        $user = new User();
        $user
            ->setUsername('user')
            ->setEnabled(true)
            ->setEmail('user@example.com')
            ->setFirstName('user_first')
            ->setLastName('user_last')
            ->setPlainPassword('user')
            ->setRoles(['ROLE_USER'])
            ->addConference($this->getReference('conference1'));
        $manager->persist($user);
        $manager->flush();
        $this->addReference('user-user', $user);

        $reviewer = new User();
        $reviewer
            ->setUsername('reviewer')
            ->setEnabled(true)
            ->setEmail('reviewer@example.com')
            ->setPlainPassword('reviewer')
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
            ->setEnabled(true)
            ->setEmail('listener@example.com')
            ->setPlainPassword('listener')
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
            ->setEnabled(true)
            ->setEmail('speaker@example.com')
            ->setPlainPassword('speaker')
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
            ->setEnabled(true)
            ->setPlainPassword('pc')
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