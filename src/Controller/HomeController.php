<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $emi): Response
    {
        // if (!$this->getUser()) {
        //     return $this->redirectToRoute('app_login');
        // }
        
        $posts = $emi->getRepository(Post::class)->findAll();
        return $this->render('home/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
