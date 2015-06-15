<?php

namespace Doofer\IamatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Interval
 *
 * @ORM\Table(name="interval")
 * @ORM\Entity(repositoryClass="Doofer\IamatBundle\Entity\IntervalRepository")
 */
class Interval
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_int", type="datetime")
     */
    private $startInt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_int", type="datetime")
     */
    private $endInt;

    /**
     * @ORM\OneToOne (targetEntity="Doofer\IamatBundle\Entity\Location")
     */
    private $location;


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
     * Set startInt
     *
     * @param \DateTime $startInt
     * @return Interval
     */
    public function setStartInt($startInt)
    {
        $this->startInt = $startInt;

        return $this;
    }

    /**
     * Get startInt
     *
     * @return \DateTime 
     */
    public function getStartInt()
    {
        return $this->startInt;
    }

    /**
     * Set endInt
     *
     * @param \DateTime $endInt
     * @return Interval
     */
    public function setEndInt($endInt)
    {
        $this->endInt = $endInt;

        return $this;
    }

    /**
     * Get endInt
     *
     * @return \DateTime 
     */
    public function getEndInt()
    {
        return $this->endInt;
    }
}
