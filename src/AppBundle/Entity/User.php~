<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $last_name;


    /**
     * @var string
     */
    private $customer;

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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $conferences;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $papers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $paperEvaluations;


    /**
     * Add conference
     *
     * @param \AppBundle\Entity\Conference $conference
     *
     * @return User
     */
    public function addConference(\AppBundle\Entity\Conference $conference)
    {
        $this->conferences[] = $conference;

        return $this;
    }

    /**
     * Remove conference
     *
     * @param \AppBundle\Entity\Conference $conference
     */
    public function removeConference(\AppBundle\Entity\Conference $conference)
    {
        $this->conferences->removeElement($conference);
    }

    /**
     * Get conferences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConferences()
    {
        return $this->conferences;
    }

    /**
     * Add paper
     *
     * @param \AppBundle\Entity\Paper $paper
     *
     * @return User
     */
    public function addPaper(\AppBundle\Entity\Paper $paper)
    {
        $this->papers[] = $paper;

        return $this;
    }

    /**
     * Remove paper
     *
     * @param \AppBundle\Entity\Paper $paper
     */
    public function removePaper(\AppBundle\Entity\Paper $paper)
    {
        $this->papers->removeElement($paper);
    }

    /**
     * Get papers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPapers()
    {
        return $this->papers;
    }

    /**
     * Add paperEvaluation
     *
     * @param \AppBundle\Entity\PaperEvaluation $paperEvaluation
     *
     * @return User
     */
    public function addPaperEvaluation(\AppBundle\Entity\PaperEvaluation $paperEvaluation)
    {
        $this->paperEvaluations[] = $paperEvaluation;

        return $this;
    }

    /**
     * Remove paperEvaluation
     *
     * @param \AppBundle\Entity\PaperEvaluation $paperEvaluation
     */
    public function removePaperEvaluation(\AppBundle\Entity\PaperEvaluation $paperEvaluation)
    {
        $this->paperEvaluations->removeElement($paperEvaluation);
    }

    /**
     * Get paperEvaluations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaperEvaluations()
    {
        return $this->paperEvaluations;
    }
}
