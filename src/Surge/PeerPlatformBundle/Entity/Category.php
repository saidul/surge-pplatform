<?php
namespace Surge\PeerPlatformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 */
class Category extends EntityBase
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
    protected $parentCategory;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="Category")
     */
    protected $childCategories;

    public function setChildCategories($childCategories)
    {
        $this->childCategories = $childCategories;
    }

    public function getChildCategories()
    {
        return $this->childCategories;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setParentCategory($parentCategory)
    {
        $this->parentCategory = $parentCategory;
    }

    public function getParentCategory()
    {
        return $this->parentCategory;
    }



}