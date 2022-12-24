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

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $qr = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($qr);
            $entityManager->flush();

            return $this->redirectToRoute('faq_list');
        }

        return $this->renderForm('faq/faq_new.html.twig', ['formQR' => $form]);
    }

    #[Route('/edit/{id}', name: 'faq_edit')]
    public function faq_edit(Request $request, $id, ManagerRegistry $doctrine): Response
    {

        $qr = new QR();

        // On charge la classe avec ce qu'il y a dans la database
        $qr = $doctrine->getRepository(QR::class)->find($id);

        // On créer le formulaire en l'initialisant avec la classe chargée au dessus
        $form = $this->createForm(QRType::class, $qr);

        $form->handleRequest($request);

        // Si soumission du formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère les données saisies
            $qr = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($qr);
            $entityManager->flush();

            return $this->redirectToRoute('faq_list');
        } else {

            return $this->renderForm('faq/faq_edit.html.twig', ['formQR' => $form]);
        }
    }

    #[Route('/memo', name: 'faq_memo')]
    public function faq_memo(Request $request, ManagerRegistry $doctrine): Response
    {

        $qr = new QR();

        $qr = $doctrine->getRepository(QR::class)->findOneBy(array('aFaire' => false));

        dd($qr);

        return $this->render('faq/faq_memo.html.twig', ['qr' => $qr]);
    }
}
