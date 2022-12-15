<?php

namespace App\Controller;

use App\Entity\QR;
use App\Form\QRType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FaqController extends AbstractController
{
    #[Route('/', name: 'faq_list')]
    public function faq_list(ManagerRegistry $doctrine): Response
    {

        $QRs = $doctrine->getRepository(QR::class)->findAll();

        //dd($QRs);

        return $this->render('faq/faq_list.html.twig', [
            'QRs' => $QRs
        ]);
    }

    #[Route('/new', name: 'faq_new')]
    public function faq_new(Request $request, ManagerRegistry $doctrine): Response
    {

        $qr = new QR();

        $form = $this->createForm(QRType::class, $qr);

        return $this->renderForm('faq/faq_new.html.twig', ['formQR' => $form]);
    }
}
