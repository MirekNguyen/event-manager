<?php

namespace App\Controller\Event;

use App\Entity\Event;
use App\Service\EventFormHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(Request $request, EventFormHandler $formHandler): Response
    {
        $form = $formHandler->handleSubmitForm($request);
        if ($formHandler->isSubmitted) {
            $this->addFlash('success', 'Event added');
            return $this->render('event/details.html.twig', [
                'event' => $formHandler->event
            ]);
        }
        return $this->render('event/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/events', name: 'app_events')]
    public function events(Request $request, EventFormHandler $formHandler): Response
    {
        $result = $formHandler->handleFilter($request);
        return $this->render('event/events.html.twig', [
            'form' => $result['form'],
            'count' => $result['count'],
            'participants' => $result['participants'],
            'pager' => $result['pager'],
        ]);
    }
    #[Route('/administration', name: 'app_administration')]
    public function administration(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Event::class);
        $events = $repository->findAll();
        return $this->render('event/administration.html.twig', [
            'events' => $events
        ]);
    }
    #[Route('event/{id}', name: 'app_details')]
    public function details(Event $event): Response
    {
        return $this->render('event/details.html.twig', [
            'event' => $event
        ]);
    }
}
