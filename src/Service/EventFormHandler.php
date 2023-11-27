<?php

namespace App\Service;

use App\Entity\Event;
use App\Form\EventFilterType;
use App\Form\EventType;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

class EventFormHandler
{
    public bool $isSubmitted = false;
    public Event $event;

    public function __construct(
        private ParameterBagInterface $params,
        private EntityManagerInterface $entityManager,
        private FormFactoryInterface $formFactory,
        private SluggerInterface $slugger,
        private FileUploader $fileUploader,
    ) {
    }

    public function handleSubmitForm(Request $request, Event $event = new Event()): FormInterface
    {
        $form = $this->formFactory->create(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->isSubmitted = true;
            $attachmentFile = $form->get('attachment_filename')->getData();
            $event = $form->getData();
            if ($attachmentFile) {
                $newFilename = $this->fileUploader->upload($attachmentFile);
                $event->setAttachmentFilename($newFilename);
            }
            $this->entityManager->persist($event);
            $this->entityManager->flush();
        }
        $this->event = $event;
        return $form;
    }
    public function handleFilter(Request $request): array
    {
        $repository = $this->entityManager->getRepository(Event::class);
        $form = $this->formFactory->create(EventFilterType::class, null, [
            'method' => 'GET'
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->isSubmitted = true;
            $filters = $form->getData();
            $queryBuilder = $repository->createQueryBuilderByFormFilter($filters);
        } else {
            $queryBuilder = $repository->createQueryBuilder('event');
        }
        $adapter = new QueryAdapter($queryBuilder);
        $pagerfanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adapter,
            $request->query->get('page', 1),
            10
        );
        $count = $pagerfanta->getNbResults();
        $queryBuilder->select('SUM(event.participants) as totalParticipants');
        $participants = $queryBuilder->getQuery()->getSingleScalarResult();
        return [
            'form' => $form,
            'count' => $count,
            'participants' => $participants,
            'pager' => $pagerfanta
        ];
    }
}
