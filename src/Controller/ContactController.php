<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    // #[Route('/contact', name: 'app_contact')]
    // public function index(Request $request, ManagerRegistry $doctrine): Response
    // {
    //     $contacts = new Contact();

    //     $form = $this->createForm(ContactType::class,$contacts)->handleRequest($request);
    //     if($form->isSubmitted() && $form->isValid()){
    //         $em = $doctrine->getManager();
    //         $em->persist($contacts);
    //         $em->flush();
    //     }
    //     return $this->render('contact/index1.html.twig',[
    //         // 'contacts' => $contacts,
    //         'form' => $form->createView(),
    //     ]);
    // }
}
