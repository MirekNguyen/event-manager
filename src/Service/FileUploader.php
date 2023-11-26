<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    public function __construct(
        private SluggerInterface $slugger,
        private ParameterBagInterface $params,
    ) {
    }
    public function upload(UploadedFile $attachmentFile)
    {
        $originalFilename = pathinfo($attachmentFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $attachmentFile->guessExtension();
        $destination = $this->params->get('attachment_directory');
        try {
            $attachmentFile->move(
                $destination,
                $newFilename
            );
        } catch (FileException) {
        }
        return $newFilename;
    }
}
