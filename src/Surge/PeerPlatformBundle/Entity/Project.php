<?php
namespace Surge\PeerPlatformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 */
class Project extends EntityBase
{

    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     */
    protected $category;

    /**
     * @ORM\Column(type="decimal")
     */
    protected $rating;

    /**
     * @ORM\Column(type="string")
     */
    protected $longitude;

    /**
     * @ORM\Column(type="string")
     */
    protected $latitude;

    /**
     * @ORM\ManyToOne(targetEntity="ProjectState")
     */
    protected $projectState;



}