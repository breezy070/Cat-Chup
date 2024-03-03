<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        //creating a random user
        $toto = new User;
        $toto->setEmail('toto@email.com');
        $toto->setFirstName('user');
        $toto->setLastName('fulano');
        $toto->setUserName('user_fulano');
        $hash = $this->passwordHasher->hashPassword($toto, 'toto');
        $toto->setPassword($hash);
        $toto->setRoles(['ROLE_USER']);
        $manager->persist($toto);

        //creating an admin
        $admin = new User();
        $admin->setEmail('admin@email.com');
        $admin->setFirstName('fabi');
        $admin->setLastName('dimarco');
        $admin->setUserName('fabi_dimarco_admin');
        $adminHash = $this->passwordHasher->hashPassword($admin, 'toto');
        $admin->setPassword($adminHash);
        //Setting the role
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        //Create a post
        $post = new Post();
        $post->setTitle('Does my cat hate me ?');
        $post->setMessage('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        // $post->setDate();
        // $post->setCreatedBy("Fabrizio");
        $post->setImage("https://images.unsplash.com/photo-1592194996308-7b43878e84a6?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
        $manager->persist($post);

        $post = new Post();
        $post->setTitle('Is your cat getting enough sleep ?');
        $post->setMessage('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.');
        // $post->setDate();
        // $post->setCreatedBy("Fabrizio");
        $post->setImage("https://images.unsplash.com/photo-1574231164645-d6f0e8553590?q=80&w=2004&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
        $manager->persist($post);

        //Create a category
        $category = new Category();
        $category->setName('Health');
        $manager->persist($category);
        $category = new Category();
        $category->setName('Safety');
        $manager->persist($category);
        $category = new Category();
        $category->setName('Food');
        $manager->persist($category);
        $category = new Category();
        $category->setName('Parenting');
        $manager->persist($category);
        $category = new Category();
        $category->setName('Adoption');
        $manager->persist($category);


        $manager->flush();
    }
}
