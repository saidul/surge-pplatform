<?php

namespace Surge\PeerPlatformBundle\Controller;

use \Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Surge\PeerPlatformBundle\Entity\User;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends BaseController{

    /**
     * User dashboard
     *
     * @Route("/dashboard", name="user_dashboard")
     * @Template()
     */
    public function dashboardAction(){
        $user = $this->getUser();
        return compact('user');
    }

}
