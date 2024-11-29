<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ParticipantFormType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ParticipantController extends AbstractController
{
    #[\Symfony\Component\Routing\Annotation\Route('/events/{id}/participant/add', name: 'app_add_participant')]
    public function index(EventRepository $eventRepository, EntityManagerInterface $entityManager, Request $request, $id): Response
    {
        $event = $eventRepository->find($id);
        $participant = new Participant();
        $participant->setEvent($event);

        $form = $this->createForm(ParticipantFormType::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($participant);
            $entityManager->flush();

            return $this->redirectToRoute('app_event_show', ['id' => $id]);
        }

        return $this->render('participant/new.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'ParticipantController',
        ]);
    }
}
