<?php

namespace App\Controller\Event;

use App\Entity\Event;
use App\Service\EventFormHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventActionController extends AbstractController
{
    #[Route('/events/{id}/edit', name: 'event_edit')]
    public function edit(Event $event, Request $request, EventFormHandler $formHandler): Response
    {
        $form = $formHandler->handleSubmitForm($request, $event);
        if ($formHandler->isSubmitted) {
            $this->addFlash('success', 'Event updated');
            return $this->render('event/details.html.twig', [
                'event' => $event
            ]);
        }
        return $this->render('event/edit.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/events/{id}/delete', name: 'event_delete')]
    public function delete(EntityManagerInterface $entityManager, Event $eventId): Response
    {
        $repository = $entityManager->getRepository(Event::class);
        $event = $repository->find($eventId);
        $entityManager->remove($event);
        $entityManager->flush();
        return $this->redirectToRoute('app_administration');
    }
}
