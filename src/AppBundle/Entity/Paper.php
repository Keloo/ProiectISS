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
class Paper
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
     * @var \AppBundle\Entity\PaperType
     */
    private $paperType;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $paperEvaluation;

    /**
     *
     * @Vich\UploadableField(mapping="paper_file", fileNameProperty="file_name")
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
     * @var \AppBundle\Entity\User
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->paperEvaluation = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Paper
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
     * @return Paper
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
     * @return Paper
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
     * Set paperType
     *
     * @param \AppBundle\Entity\PaperType $paperType
     *
     * @return Paper
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
     * Add paperEvaluation
     *
     * @param \AppBundle\Entity\PaperEvaluation $paperEvaluation
     *
     * @return Paper
     */
    public function addPaperEvaluation(\AppBundle\Entity\PaperEvaluation $paperEvaluation)
    {
        $this->paperEvaluation[] = $paperEvaluation;

        return $this;
    }

    /**
     * Remove paperEvaluation
     *
     * @param \AppBundle\Entity\PaperEvaluation $paperEvaluation
     */
    public function removePaperEvaluation(\AppBundle\Entity\PaperEvaluation $paperEvaluation)
    {
        $this->paperEvaluation->removeElement($paperEvaluation);
    }

    /**
     * Get paperEvaluation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaperEvaluation()
    {
        return $this->paperEvaluation;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Paper
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
     * @var \DateTime
     */
    private $updated_at;


    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Paper
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
}
