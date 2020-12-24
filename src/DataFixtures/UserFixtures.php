<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function loadData(): void
    {
        $this->createMany(1, 'user_admin', function() {
            $user = new User();
            return $user 
            ->setEmail('admin1'. '@velonaute.fr')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->encoder->encodePassword($user, 'admin1'))
            ->setPseudo('admin')
            ->setNom('admin')            
            ->setAdresse('adminrue')            
            ->setVille('adminville')            
            ->setCp('58825')           
            ->setPrenom('admin')
        ;
        });

        $this->createMany(10, 'user_user', function (int $num) {
            $user = new User();
            $password = $this->encoder->encodePassword($user, 'user' . $num);
            return $user
                ->setEmail('user' . $num . '@velonaute.fr')
                ->setPassword($password)
                ->setPseudo('user' . $num)
                ->setNom($this->faker->firstName)            
                ->setAdresse($this->faker->address)            
                ->setVille($this->faker->city)            
                ->setCp('7000')           
                ->setPrenom($this->faker->lastName)
            ;
        });
    }
}
