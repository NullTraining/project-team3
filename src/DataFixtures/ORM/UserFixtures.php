<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setPlainPassword('admin');
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_SUPER_ADMIN']);
        $admin->setEnabled(true);
        $manager->persist($admin);
        $manager->flush();
        $this->addReference('user-admin', $admin);

        $user = new User();
        $user->setUsername('user');
        $user->setPlainPassword('user');
        $user->setEmail('user@example.com');
        $user->setEnabled(true);
        $manager->persist($user);
        $manager->flush();
        $this->addReference('user', $user);
    }

    public function getOrder()
    {
        return 5;
    }
}
