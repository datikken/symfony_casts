<?php

namespace App\Service;

use League\Flysystem\Filesystem;
use Psr\Log\LoggerInterface;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Sluggable\Util\Urlizer;


class UploadService
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(
        Filesystem $filesystem,
        LoggerInterface $logger
    )
    {
        $this->filesystem = $filesystem;
        $this->logger = $logger;
    }

    /**
     * @param UploadedFile $file
     * @return string
     * @throws \League\Flysystem\FilesystemException
     */
    public function upload(UploadedFile $file): string
    {
        if ($file instanceof UploadedFile) {
            $originalFilename = $file->getClientOriginalName();
        } else {
            $originalFilename = $file->getFilename();
        }

        $newFilename = Urlizer::urlize(pathinfo($originalFilename, PATHINFO_FILENAME)).'-'.uniqid().'.'.$file->guessExtension();

        $stream = fopen($file->getRealPath(), 'r');
        $this->filesystem->writeStream(
          $newFilename,
          $stream
        );
        fclose($stream);

        return $newFilename;
    }

    /**
     * @param string $file
     * @return void
     * @throws \League\Flysystem\FilesystemException
     */
    public function remove(string $file): void
    {
        try {
            $this->filesystem->delete($file);
        } catch (FileNotFoundException $e)
        {
            $this->logger->alert(sprintf('Uploaded file is missing', $file));
        }
    }

    /**
     * @param string $file
     * @return string
     * @throws \League\Flysystem\FilesystemException
     */
    public function read(string $file)
    {
        return $this->filesystem->readStream($file);
    }
}