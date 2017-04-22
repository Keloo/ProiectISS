<?php

namespace AppBundle\Entity;

/**
 * PaperEvaluation
 */
class PaperEvaluation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $message;

    /**
     * @var integer
     */
    private $rate;

    /**
     * @var \AppBundle\Entity\Paper
     */
    private $paper;


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
     * Set message
     *
     * @param string $message
     *
     * @return PaperEvaluation
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set rate
     *
     * @param integer $rate
     *
     * @return PaperEvaluation
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return integer
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set paper
     *
     * @param \AppBundle\Entity\Paper $paper
     *
     * @return PaperEvaluation
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
