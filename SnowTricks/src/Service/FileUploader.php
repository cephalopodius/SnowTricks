<?php
// src/Service/FileUploader.php

namespace App\Service;

use App\Entity\Gallery;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
    {
        private $uploadsPath;

        public function __construct(string $uploadsPath)
        {
            $this->uploadsPath = $uploadsPath;
        }

    public function uploadFile($file): string
    {

            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $file->move(
                    $this->uploadsPath.'',
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }



        return $newFilename;
        }

}