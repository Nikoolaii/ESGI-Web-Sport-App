<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use App\Service\DistanceCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{
    #[Route('/events', name: 'app_event')]
    public function listEvents(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();

        return $this->render('event/list.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('/events/{id}', name: 'app_event_show')]
    public function viewEvent(Event $event): Response
    {
        return $this->render('event/view.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/events/{id}/distance?{long}&{lat}', name: 'app_event_distance')]
    public function calculateDistance(Event $event, float $long, float $lat): Response
    {
        $eventLong = $event->getLongitude();
        $eventLat = $event->getLatitude();

        $distanceCalculator = new DistanceCalculator();
        $distance = $distanceCalculator->calculateDistance($eventLat, $eventLong, $lat, $long);

        return $this->render('event/distance.html.twig', [
            'event' => $event,
            'distance' => $distance,
        ]);
    }
}
