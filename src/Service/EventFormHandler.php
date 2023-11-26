<?php

namespace App\Service;

use App\Entity\Event;
use App\Form\EventType;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

class EventFormHandler
{
    public bool $isSubmitted = false;

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
                # $originalFilename = pathinfo($attachmentFile->getClientOriginalName(), PATHINFO_FILENAME);
                # $safeFilename = $this->slugger->slug($originalFilename);
                # $newFilename = $safeFilename . '-' . uniqid() . '.' . $attachmentFile->guessExtension();
                # $destination = $this->params->get('attachment_directory');
                # try {
                #     $attachmentFile->move(
                #         $destination,
                #         $newFilename
                #     );
                # } catch (FileException) {
                # }
                $newFilename = $this->fileUploader->upload($attachmentFile);
                $event->setAttachmentFilename($newFilename);
            }
            $this->entityManager->persist($event);
            $this->entityManager->flush();
        }
        return $form;
    }
}
