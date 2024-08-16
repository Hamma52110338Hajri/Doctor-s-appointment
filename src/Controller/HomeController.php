<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\Contact;
use App\Entity\Doctor;
use App\Form\ContactType;
use App\Repository\DoctorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, ManagerRegistry $doctrine, DoctorRepository $doctorRepository): Response
    {
        $contacts = new Contact();
        $appointment = new Appointment();
        $doctors = new Doctor();

        $form = $this->createForm(ContactType::class,$contacts)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($contacts);
            $em->flush();
        }
        return $this->render('home/index.html.twig',[
            'doctors' => $doctorRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

   

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/index.html.twig');

    }
 }