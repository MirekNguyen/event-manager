<?php

namespace App\Controller\Event;

use App\Entity\Event;
use App\Form\EventFilterType;
use App\Form\EventType;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $event = $form->getData();
            $entityManager->persist($event);
            $entityManager->flush();

            $this->addFlash('success', 'Event added ');
        }

        return $this->render('event/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/events', name: 'app_events')]
    public function events(EntityManagerInterface $entityManager, Request $request): Response
    {
        $repository = $entityManager->getRepository(Event::class);
        $criteria = Criteria::create();

        $form = $this->createForm(EventFilterType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $criteria->andWhere(Criteria::expr()->contains('name', $data['nameFilter']));
        }
        $events = $repository->findByCriteria($criteria);
        return $this->render('event/events.html.twig', [
            'form' => $form,
            'events' => $events
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
