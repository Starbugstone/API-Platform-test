<?php

namespace App\DataFixtures;

use App\Entity\MyUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;


class MyUserFixtures extends Fixture{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager){
        $faker = Factory::create();

        $userAdmin = new MyUser();
        $userAdmin->setUsername('admin')
            ->setRoles(['ROLE_ADMIN']);
        $userAdmin->setPassword($this->passwordEncoder->encodePassword(
                $userAdmin,
                'admin'
            ));
        $manager->persist($userAdmin);

        $userClient1 = new MyUser();
        $userClient1->setUsername('client1')
            ->setRoles(['ROLE_CLIENT']);
        $userClient1->setPassword($this->passwordEncoder->encodePassword(
            $userClient1,
            'client1'
        ));
        $manager->persist($userClient1);

        $userClient2 = new MyUser();
        $userClient2->setUsername('client2')
            ->setRoles(['ROLE_CLIENT']);
        $userClient2->setPassword($this->passwordEncoder->encodePassword(
            $userClient2,
            'client2'
        ));
        $manager->persist($userClient2);

        for($i=0; $i<10; $i++){
            $user = new MyUser();
            $user->setUsername('user'.$i)
                ->setRoles(['ROLE_USER'])
                ->setClient($userClient1);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'user'.$i
                ));
            $manager->persist($user);
        }

        $manager->flush();
    }
}