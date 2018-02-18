<?php

namespace App\DataFixtures\ORM;

use App\Entity\Workshop;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class WorkshopFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $html = new Workshop();
        $html->setTitle('HTML basics');
        $html->setDescription('In this workshop we will cover html basics');
        $html->setDate(new DateTime());
        $html->setActive(true);

        $css = new Workshop();
        $css->setTitle('CSS basics');
        $css->setDescription('In this workshop we will cover css basics');
        $css->setDate(new DateTime());
        $css->setActive(false);

        $manager->persist($html);
        $manager->persist($css);
        $manager->flush();

        $this->addReference('workshop-html', $html);
        $this->addReference('workshop-css', $css);
    }

    public function getOrder()
    {
        return 10;
    }
}
