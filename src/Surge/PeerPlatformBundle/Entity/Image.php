<?php
namespace Surge\PeerPlatformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Image extends File
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
    protected $exifInfo;


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

    public function setExifInfo($exifInfo)
    {
        $this->exifInfo = $exifInfo;
    }

    public function getExifInfo()
    {
        return $this->exifInfo;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setTmpPath($tmpPath)
    {
        $this->tmpPath = $tmpPath;
    }

    public function getTmpPath()
    {
        return $this->tmpPath;
    }




}