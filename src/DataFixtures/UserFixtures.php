<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public const USUARIO_ADMIN_REFERENCIA = 'user-admin';
    public const USUARIO_USER_REFERENCIA = 'user-user';

    private UserPasswordEncoderInterface $userPasswordEncoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder ;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Admin user
        $usuario = new User();
        $usuario->setEmail('admin@admin.com');
        $usuario->setRoles(['ROLE_ADMIN']);
        $usuario->setPassword(
            $this->userPasswordEncoder->encodePassword($usuario, 'admin')
        );
        $manager->persist($usuario);
        $manager->flush();
        $this->addReference(self::USUARIO_ADMIN_REFERENCIA, $usuario);

        // User user
        $usuario = new User();
        $usuario->setEmail('user@user.com');
        $usuario->setRoles(['ROLE_USER']);
        $usuario->setPassword(
            $this->userPasswordEncoder->encodePassword($usuario, 'user')
        );
        $manager->persist($usuario);
        $manager->flush();
        $this->addReference(self::USUARIO_USER_REFERENCIA, $usuario);
    }


}
