<?php
namespace Surge\PeerPlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class SiteOption
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    protected $id;

    /**
     * @ORM\Column(type="object")
     */
    protected $value;

    function __construct($id=null, $value=null){
        $this->setId($id);
        $this->setValue($value);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }


}