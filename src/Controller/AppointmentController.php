<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Form\AppointmentType;
use App\Repository\AppointmentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/appointment')]
class AppointmentController extends AbstractController
{
    #[Route('/', name: 'appointment_show')]
    public function show(AppointmentRepository $appointmentRepository): Response
    {
        $appointment = $appointmentRepository->findAll();

        return $this->render('appointment/index.html.twig', [
            'appointmrnt' => $appointment ,
        ]);
    }

    #[Route('/create', name: 'appointment_create')]
    public function create(Request $request,ManagerRegistry $doctrine): Response
    {
        $appointment = new Appointment();
        $form = $this->createForm(AppointmentType::class,$appointment)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($appointment);
            $em->flush();
        }

        return $this->render('appointment/create.html.twig', [
            'appointment' => $appointment,
            'form' => $form->createView()
        ]);
    }

    #[Route('/edit/{id}', name: 'appointment_edit')]
    public function edit(Request $request,ManagerRegistry $doctrine, Appointment $appointment): Response
    {
        $form = $this->createForm(AppointmentType::class,$appointment)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($appointment);
            $em->flush();
        }

        return $this->render('appointment/edit.html.twig', [
            'appointment' => $appointment,
            'form' => $form->createView(),

        ]);
    }

    #[Route('/delete/{id}', name: 'appointment_delete')]
    public function delete(ManagerRegistry $doctrine, Appointment $appointment): Response
    {
        $em = $doctrine->getManager();
        $em->remove($appointment);
        $em->flush();
        return $this->redirectToRoute('appointment_show');
    }
}
