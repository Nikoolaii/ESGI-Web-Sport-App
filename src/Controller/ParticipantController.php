<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ParticipantFormType;
use App\Repository\EventRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends AbstractController
{
    #[Route('/events/{id}/participant/add', name: 'app_add_participant')]
    public function index(EventRepository $eventRepository, EntityManagerInterface $entityManager, Request $request, $id): Response
    {
        $event = $eventRepository->find($id);
        $participant = new Participant();
        $participant->setEvent($event);

        $form = $this->createForm(ParticipantFormType::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($event->getDate() < new DateTime()) {
                $this->addFlash('error', 'You cannot add a participant to a past event');
            }

            if($event->getParticipantByEmail($participant->getEmail())) {
                $this->addFlash('error', 'This email is already registered for this event');
            } else {
                $entityManager->persist($participant);
                $entityManager->flush();

                $this->addFlash('success', 'Participant added successfully');
            }
            return $this->redirectToRoute('app_event_show', ['id' => $id]);
        }

        return $this->render('participant/new.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'ParticipantController',
        ]);
    }
}
