<?php

namespace AppBundle\Entity;

/**
 * Conference
 */
class Conference
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
     * @var \DateTime
     */
    private $start_time;

    /**
     * @var \DateTime
     */
    private $end_time;

    /**
     * @var \DateTime
     */
    private $call_for_papers_start;

    /**
     * @var \DateTime
     */
    private $call_for_papers_end;

    /**
     * @var \DateTime
     */
    private $paper_submission_start;

    /**
     * @var \DateTime
     */
    private $paper_submission_end;

    /**
     * @var \AppBundle\Entity\User
     */
    private $user;


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
     * @return Conference
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
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return Conference
     */
    public function setStartTime($startTime)
    {
        $this->start_time = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return Conference
     */
    public function setEndTime($endTime)
    {
        $this->end_time = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * Set callForPapersStart
     *
     * @param \DateTime $callForPapersStart
     *
     * @return Conference
     */
    public function setCallForPapersStart($callForPapersStart)
    {
        $this->call_for_papers_start = $callForPapersStart;

        return $this;
    }

    /**
     * Get callForPapersStart
     *
     * @return \DateTime
     */
    public function getCallForPapersStart()
    {
        return $this->call_for_papers_start;
    }

    /**
     * Set callForPapersEnd
     *
     * @param \DateTime $callForPapersEnd
     *
     * @return Conference
     */
    public function setCallForPapersEnd($callForPapersEnd)
    {
        $this->call_for_papers_end = $callForPapersEnd;

        return $this;
    }

    /**
     * Get callForPapersEnd
     *
     * @return \DateTime
     */
    public function getCallForPapersEnd()
    {
        return $this->call_for_papers_end;
    }

    /**
     * Set paperSubmissionStart
     *
     * @param \DateTime $paperSubmissionStart
     *
     * @return Conference
     */
    public function setPaperSubmissionStart($paperSubmissionStart)
    {
        $this->paper_submission_start = $paperSubmissionStart;

        return $this;
    }

    /**
     * Get paperSubmissionStart
     *
     * @return \DateTime
     */
    public function getPaperSubmissionStart()
    {
        return $this->paper_submission_start;
    }

    /**
     * Set paperSubmissionEnd
     *
     * @param \DateTime $paperSubmissionEnd
     *
     * @return Conference
     */
    public function setPaperSubmissionEnd($paperSubmissionEnd)
    {
        $this->paper_submission_end = $paperSubmissionEnd;

        return $this;
    }

    /**
     * Get paperSubmissionEnd
     *
     * @return \DateTime
     */
    public function getPaperSubmissionEnd()
    {
        return $this->paper_submission_end;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Conference
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
