<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user 
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
        $manager->persist($user);
        $manager->flush();
    }
}
