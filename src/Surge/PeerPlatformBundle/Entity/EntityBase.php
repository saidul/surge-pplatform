<?php
namespace Surge\PeerPlatformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * http://www.doctrine-project.org/docs/orm/2.0/en/reference/events.html#lifecycle-callbacks
 *
 * @ORM\MappedSuperclass
 */
abstract class EntityBase {
    /**
     *
     * @ORM\Column(type="datetime")
     */
    protected $createdOn;
    /**
     *
     * @ORM\Column(type="datetime")
     */
    protected $updatedOn;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $createdBy;

    protected $slug;
    /**
     * used to identify the entity over URL paths
     * @ORM\Column(type="string", length=255) 
     */
    protected $hash;

    /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    protected $locale;

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime $createdOn
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set updatedOn
     *
     * @param \DateTime $updatedOn
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
    }

    /**
     * Get updatedOn
     *
     * @return \DateTime $updatedOn
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set createdBy
     *
     * @param Surge\PeerPlatformBundle\Entity\User $createdBy
     */
    public function setCreatedBy(User $createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * Get createdBy
     *
     * @return Surge\PeerPlatformBundle\Entity\User $createdBy
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set hash
     *
     * @param string $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * Get hash
     *
     * @return string $hash
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        $title = $this->__toString();
        if (!$title) {
            $title = 'temp-'.rand(0, 100000);
        }

        return $title;
    }

    public function __toString() {
        return 'base-tmp-'.rand(0, 100000);
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    public function getLocale()
    {
        return $this->locale;
    }


}