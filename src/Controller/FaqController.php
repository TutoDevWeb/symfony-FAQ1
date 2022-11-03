<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FaqController extends AbstractController
{
    #[Route('/', name: 'app_faq')]
    public function faq(): Response
    {
        return $this->render('faq/faq.html.twig', [
            'controller_name' => 'FaqController',
        ]);
    }
}
