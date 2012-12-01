<?php
/**
 * Created by JetBrains PhpStorm.
 * User: shimul
 * Date: 4/29/12
 * Time: 3:07 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Surge\PeerPlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Symfony\Component\Security\Core\Role\Role as CoreRole;

/**
 * Role Entity
 *
 * @ORM\Entity
 * @ORM\Table( name="UserRole" )
 *
 */
class Role extends CoreRole
{

    const ROLE_ADMIN        = 'ROLE_ADMIN';
    const ROLE_USER         = 'ROLE_USER';
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="role", unique="true", length="70")
     */
    private $role;

    /**
     * Populate the role field
     * @param string $role ROLE_FOO etc
     */
    public function __construct( $role )
    {
        $this->role = $role;
    }

    /**
     * Return the role field.
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Return the role field.
     * @return string
     */
    public function __toString()
    {
        return (string) $this->role;
    }

}