<?php

namespace App\Controller\Event;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventActionController extends AbstractController
{
    #[Route('/events/{id}/edit', name: 'event_edit')]
    public function edit(): Response
    {
        return $this->redirectToRoute('app_events');
    }
    #[Route('/events/{id}/delete', name: 'event_delete')]
    public function delete(EntityManagerInterface $entityManager, Event $eventId): Response
    {
        $repository = $entityManager->getRepository(Event::class);
        $event = $repository->find($eventId);
        $entityManager->remove($event);
        $entityManager->flush();
        return $this->redirectToRoute('app_events');
    }
}
