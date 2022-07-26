<?php

namespace App\Controller;

use App\Repository\NiveauxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(NiveauxRepository $niveauxRepos): Response
    {
        $niveaux = $niveauxRepos->findAll();

        return $this->render('blog/index.html.twig', [
            'niveaux' => $niveaux,
        ]);
    }
}