<?php

namespace App\DataFixtures;

use App\Entity\Tarea;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TareaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<=20; $i++) {
            $tarea = new Tarea();
            $tarea->setDescripcion("Descripcion test $i");
            $manager->persist($tarea);
        }

        $manager->flush();
    }
}
