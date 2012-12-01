<?php
namespace Surge\PeerPlatformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Video extends File
{

    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="object")
     */
    protected $videoInfo;


    /**
     * @ORM\Column(type="string")
     */
    protected $longitude;

    /**
     * @ORM\Column(type="string")
     */
    protected $latitude;

    /**
     * @ORM\Column(type="integer")
     */
    protected $height;
    /**
     * @ORM\Column(type="integer")
     */
    protected $width;




}