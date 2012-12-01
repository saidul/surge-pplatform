<?php
/**
 * Created by JetBrains PhpStorm.
 * User: COMPAQ
 * Date: 2/11/12
 * Time: 1:48 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Surge\PeerPlatformBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank
     */
    protected  $firstName;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected  $lastName;


    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected  $dateOfBirth;

    /**
     * @ORM\ManyToMany(targetEntity="Role")
     */
    protected $userRoles;

    /**
     * @ORM\Column(type="string")
     */
    protected $gender;



    function __construct(){
        $this->hasAcceptedTermsAndCondition = false;
        $this->isBlogger = false;
        $this->locale = 'en';
        $this->gender = 'M';
        $this->userRoles = new ArrayCollection();
        $this->registeredOn = new \DateTime();
        $this->approved = true;
        parent::__construct();

    }

    function getName() {
        $name = $this->firstName;
        if($this->lastName)
            $name .= " {$this->lastName}";

        if(!$name) $name = $this->username;

        return $name;
    }

    public function setApproved($approved)
    {
        $this->approved = $approved;
    }

    public function getApproved()
    {
        return $this->approved;
    }


    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }


    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setHasAcceptedTermsAndCondition($hasAcceptedTermsAndCondition)
    {
        $this->hasAcceptedTermsAndCondition = $hasAcceptedTermsAndCondition;
    }

    public function getHasAcceptedTermsAndCondition()
    {
        return $this->hasAcceptedTermsAndCondition;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }




    //... existing setters/getters

    /**
     * Returns an ARRAY of Role objects with the default Role object appended.
     * @return array
     */
    public function getRoles()
    {
        return array_merge( $this->userRoles->toArray(), array( new Role( parent::ROLE_DEFAULT ) ) );
    }

    /**
     * Returns the true ArrayCollection of UserRoles.
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getRolesCollection()
    {
        return $this->userRoles;
    }

    /**
     * Pass a string, get the desired Role object or null.
     * @param string $role
     * @return Role|null
     */
    public function getRole( $role )
    {
        foreach ( $this->getRoles() as $roleItem )
        {
            if ( $role == $roleItem->getRole() )
            {
                return $roleItem;
            }
        }
        return null;
    }

    /**
     * Pass a string, checks if we have that Role. Same functionality as getRole() except returns a real boolean.
     * @param string $role
     * @return boolean
     */
    public function hasRole( $role )
    {
        if ( $this->getRole( $role ) )
        {
            return true;
        }
        return false;
    }

    /**
     * Adds a Role OBJECT to the ArrayCollection. Can't type hint due to interface so throws Exception.
     * @throws Exception
     * @param Role $role
     */
    public function addRole( $role )
    {
        if ( !$role instanceof Role )
        {
            echo  $role;
            throw new \Exception( "addRole takes a Role object as the parameter" );
        }

        if ( !$this->hasRole( $role->getRole() ) )
        {
            $this->userRoles->add( $role );
        }
    }

    /**
     * Pass a string, remove the Role object from collection.
     * @param string $role
     */
    public function removeRole( $role )
    {
        $roleElement = $this->getRole( $role );
        if ( $roleElement )
        {
            $this->userRoles->removeElement( $roleElement );
        }
    }

    /**
     * Pass an ARRAY of Role objects and will clear the collection and re-set it with new UserRoles.
     * Type hinted array due to interface.
     * @param array $userRoles Of Role objects.
     */
    public function setRoles( array $userRoles )
    {
        $this->userRoles->clear();
        foreach ( $userRoles as $role )
        {
            $this->addRole( $role );
        }
    }

    /**
     * Directly set the ArrayCollection of UserRoles. Type hinted as Collection which is the parent of (Array|Persistent)Collection.
     * @param Doctrine\Common\Collections\Collection $role
     */
    public function setRolesCollection( Collection $collection )
    {
        $this->userRoles = $collection;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Get userRoles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserRoles()
    {
        return $this->userRoles;
    }
}