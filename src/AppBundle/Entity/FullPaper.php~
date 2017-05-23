<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping\Entity;

/**
 * Paper
 * @Entity
 * @Vich\Uploadable
 */
class FullPaper
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $file_name;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \AppBundle\Entity\PaperType
     */
    private $paperType;

    /**
     * @var \AppBundle\Entity\User
     */
    private $user;



    /**
     *
     * @Vich\UploadableField(mapping="paper_file", fileNameProperty="fileName")
     *
     * @var File
     */
    private $paper_file;

    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return Paper
     */
    public function setPaperFile(File $file = null)
    {
        $this->paper_file = $file;

        if ($file) {
            $this->updated_at = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getPaperFile()
    {
        return $this->paper_file;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle()?$this->getTitle():'';
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return FullPaper
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return FullPaper
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     *
     * @return FullPaper
     */
    public function setFileName($fileName)
    {
        $this->file_name = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return FullPaper
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set paperType
     *
     * @param \AppBundle\Entity\PaperType $paperType
     *
     * @return FullPaper
     */
    public function setPaperType(\AppBundle\Entity\PaperType $paperType = null)
    {
        $this->paperType = $paperType;

        return $this;
    }

    /**
     * Get paperType
     *
     * @return \AppBundle\Entity\PaperType
     */
    public function getPaperType()
    {
        return $this->paperType;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return FullPaper
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var string
     */
    private $meta_info;


    /**
     * Set metaInfo
     *
     * @param string $metaInfo
     *
     * @return FullPaper
     */
    public function setMetaInfo($metaInfo)
    {
        $this->meta_info = $metaInfo;

        return $this;
    }

    /**
     * Get metaInfo
     *
     * @return string
     */
    public function getMetaInfo()
    {
        return $this->meta_info;
    }
}
