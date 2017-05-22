<?php

namespace AppBundle\Entity;

/**
 * PaperType
 */
class PaperType
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \AppBundle\Entity\Paper
     */
    private $paper;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName()?$this->getName():'';
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
     * Set name
     *
     * @param string $name
     *
     * @return PaperType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set paper
     *
     * @param \AppBundle\Entity\Paper $paper
     *
     * @return PaperType
     */
    public function setPaper(\AppBundle\Entity\Paper $paper = null)
    {
        $this->paper = $paper;

        return $this;
    }

    /**
     * Get paper
     *
     * @return \AppBundle\Entity\Paper
     */
    public function getPaper()
    {
        return $this->paper;
    }
}
