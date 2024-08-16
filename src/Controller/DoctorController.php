<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Form\DoctorType;
use App\Repository\DoctorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/doctor')]
class DoctorController extends AbstractController
{
    #[Route('/', name: 'doctor_show')]
    public function index(DoctorRepository $doctorRepository): Response
    {
        $doctors = new Doctor();
        $doctors = $doctorRepository->findAll();

        return $this->render('doctor/list.html.twig',[
            'doctors' => $doctors
        ]);
    }

    #[Route('/create', name: 'doctor_create')]
    public function create(Request $request,ManagerRegistry $doctrine): Response
    {
        $doctors = new Doctor();
        $form = $this->createForm(DoctorType::class,$doctors)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($doctors);
            $em->flush();
        }

        return $this->render('doctor/create.html.twig', [
            'doctors' => $doctors,
            'form' => $form->createView()
        ]);
    }

    #[Route('/edit/{id}', name: 'doctor_edit')]
    public function edit(Request $request,ManagerRegistry $doctrine, Doctor $doctor): Response
    {
        $form = $this->createForm(DoctorType::class,$doctor)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($doctor);
            $em->flush();
        }

        return $this->render('doctor/edit.html.twig', [
            'doctor' => $doctor,
            'form' => $form->createView(),

        ]);
    }

    #[Route('/delete/{id}', name: 'doctor_delete')]
    public function delete(ManagerRegistry $doctrine, Doctor $doctor): Response
    {
        $em = $doctrine->getManager();
        $em->remove($doctor);
        $em->flush();
        return $this->redirectToRoute('doctor_show');
    }
}
