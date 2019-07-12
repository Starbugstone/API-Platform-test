<?php

namespace App\DataFixtures\Faker;

use App\Entity\MyUser;
use Faker\Generator;
use Faker\Provider\Base as BaseProvider;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FooProvider extends abstractLoa
{


    public function foo($str,MyUser $user, UserPasswordEncoderInterface $passwordEncoder)
    {

        return 'foo'.$str;
    }
}