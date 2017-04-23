<?php

namespace AppBundle\Entity;

/**
 * Paper
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
    private $file;

    /**
     * @var \AppBundle\Entity\PaperType
     */
    private $paperType;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $paperEvaluation;

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
     * Set file
     *
     * @param string $file
     *
     * @return Paper
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
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
}