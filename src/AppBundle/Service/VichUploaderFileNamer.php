<?php

namespace AppBundle\Service;

use AppBundle\Entity\FullPaper;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\NamerInterface;

class VichUploaderFileNamer implements NamerInterface
{
    /** @var User  */
    protected $user;

    /**
     * VichUploaderFileNamer constructor.
     * @param TokenStorage $tokenStorage
     */
    public function __construct(TokenStorage $tokenStorage)
    {
        $this->user = $tokenStorage->getToken()->getUser();
    }

    /**
     * @param object $object
     * @param PropertyMapping $mapping
     * @return string
     */
    public function name($object, PropertyMapping $mapping)
    {
        /** @var UploadedFile $file */
        $file = $object->getPaperFile();

        $prefix = '';
        if ($object instanceof FullPaper) {
            $prefix = 'full-';
        }

        $extension = $file->getExtension();
        if (!$extension) {
            $extension = $file->guessExtension();
        }

        return $prefix.$this->user->getUsername().'-'.$object->getTitle().'.'.$extension;
    }
}