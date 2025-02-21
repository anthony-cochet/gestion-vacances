<?php

namespace App\DataFixtures;

use App\Entity\AdminUser;
use App\Entity\Vacances;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Creating an employee
        $employe = new AdminUser();
        $employe->setNom("Jean Dupont");
        $manager->persist($employe);

        // Creating vacation for this employee
        $vacances = new Vacances();
        $vacances->setEmploye($employe);
        $vacances->setDateDebut(new \DateTime('2025-07-01'));
        $vacances->setDateFin(new \DateTime('2025-07-15'));
        $vacances->setJoursFeries([]);

        $manager->persist($vacances);
        $manager->flush();
    }
}
