<?php
namespace Surge\PeerPlatformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 */
class SurveyQuestion extends EntityBase
{

    const QTYPE_RADIO_CHOICE = 1;
    const QTYPE_LIST_CHOICE = 2;
    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Survey")
     */
    protected $survey;

    /**
     * @ORM\Column(type="integer")
     */
    protected $qustionType;

    /**
     * @ORM\OneToMany(targetEntity="SurveyOption", mappedBy="question")
     */
    protected $options;

}