<?php

namespace AppBundle\Service;

use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\NamerInterface;

class VichUploaderFileNamer implements NamerInterface
{
    /**
     * @param object $object
     * @param PropertyMapping $mapping
     * @return string
     */
    public function name($object, PropertyMapping $mapping)
    {
        /** @var User $user */
        $user = $object->getUser();
        /** @var UploadedFile $file */
        $file = $object->getPaperFile();

        $extension = $file->getExtension();
        if (!$extension) {
            $extension = $file->guessExtension();
        }

        return $user->getUsername().'-'.$object->getTitle().'.'.$extension;
    }
}