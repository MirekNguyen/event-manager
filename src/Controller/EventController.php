<?php

namespace App\Controller;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }

    #[Route('/events', name: 'app_events')]
    public function events(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Event::class);
        $events = $repository->findAll();
        return $this->render('event/events.html.twig', [
            'events' => $events
        ]);
    }
}
