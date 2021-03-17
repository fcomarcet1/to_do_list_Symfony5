<?php

namespace App\DataFixtures;

use App\Entity\Tarea;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TareaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<=5; $i++) {
            $tarea = new Tarea();
            $tarea->setDescripcion("Tarea de prueba - Admin - $i");
            $tarea->setFinalizada(0);
            // Añadimos referencia de user
            $tarea->setUsuario($this->getReference(UserFixtures::USUARIO_ADMIN_REFERENCIA));

            $manager->persist($tarea);
        }

        for ($i=0; $i<=20; $i++) {
            $tarea = new Tarea();
            $tarea->setDescripcion("Tarea de prueba - User - $i");
            $tarea->setFinalizada(0);
            // Añadimos referencia de user
            $tarea->setUsuario($this->getReference(UserFixtures::USUARIO_USER_REFERENCIA));

            $manager->persist($tarea);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
       return [
           UserFixtures::class,
       ];
    }
}
