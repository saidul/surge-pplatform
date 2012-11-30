<?php
namespace Surge\PeerPlatformBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @author Saidul
 */
class BaseController extends Controller
{
    /**
     * @var Array
     */
    protected $data;

    protected $hasError = false;


    protected function getUrlContent($url)
    {
        $ch = curl_init( $url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Get the data:
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;

    }
    /**
     * Sets data to be passed to template
     * @param string $key  variable name in template
     * @param mixed $data data
     */
    public function setData($key, $data)
    {
        $this->data["$key"] = $data;
    }

    /**
     * Set data from array
     * @param array $data
     */
    public function setArrayData(array $data)
    {
        foreach ($data as $k => $v)
            $this->setData($k, $v);
    }

    /**
     * get data stored in location $key
     * @param string $key
     * @return mixed
     */
    public function getData($key)
    {
        return isset($this->data["$key"]) ? $this->data["$key"] : null;
    }

    /**
     * Get all data stored using setData.
     * @return mixed
     */
    public function getAllData()
    {
        return $this->data?$this->data:array();
    }

    /**
     * @param $action
     * @param $object
     * @param bool $throwException if true then throw expection in case of failure. otherwise just return the result.
     * @return mixed
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     */
    public function authorizeAction($action, $object, $throwException = true)
    {
        $action = strtoupper($action);
        /** @var $securityContext \Symfony\Component\Security\Core\SecurityContextInterface */
        $securityContext = $this->get('security.context');

        if(false == $result = $securityContext->isGranted($action, $object)) {
            $objectIdentity = new ObjectIdentity('class', get_class($object));
            $result = $securityContext->isGranted($action, $objectIdentity);
        }

        if (false === $result && $throwException) {
            throw new AccessDeniedException();
        }

        return $result;
    }

    /**
     * @return \FOS\UserBundle\Model\UserManager
     */
    protected function getUserManager(){
        return $this->get('fos_user.user_manager');
    }

    public function getSettingsById($name)
    {
        $siteOption = $this->getMainRepo()->getSettings($name);
        if($siteOption == null) throw new \Exception("Site option \"$name\" does not exist");
        return $siteOption->getValue();
    }

    /**
     * @param bool $throwExeption
     * @return \Surge\PeerPlatformBundle\Entity\User
     */
    public function getUser($throwExeption = true){
        $token = $this->container->get('security.context')->getToken();
        $user = ($token->getUser() == "anon.") ? null : $token->getUser();

        if ($throwExeption && !$user) {
           throw new AccessDeniedException("User is null");

        }

        return $user;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Session
     */
    protected function getSession(){
        return $this->container->get('session');
    }

    protected function setFlash($action, $value)
    {
        $this->getSession()->setFlash($action, $value);
    }

    protected function setNotificationMsg($msg, $type='info')
    {
        $clientMsgs = $this->getSession()->get('_notifications', array());
        $clientMsgs[$type][] = $msg;
        $this->getSession()->set('_notifications', $clientMsgs);

        if($type == 'error') $this->hasError = true;

    }

    protected function clearNotificationMsgs()
    {
        $this->getSession()->remove('_notifications');
        $this->hasError = false;
    }

    protected function hasError(){
        return $this->hasError;
    }

    protected function getFlash($action, $defaultValue)
    {
        $this->getSession()->getFlash($action, $defaultValue);
    }
    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager(){
        return $this->getDoctrine()->getEntityManager();
    }

    protected function paginateQuery($query, $options = array()){
        $defaultOptions = array(
            'pageParameterName' => 'page',
            'maxItemParameterName' => 'maxItem',
            'sortFieldParameterName' => 'sort',
            'sortDirectionParameterName' => 'direction',
            'distinct' => true
        );

        $options = array_merge($defaultOptions, $options);

        /** @var $paginator \Knp\Component\Pager\Paginator */
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query ,
            $this->getRequest()->query->get($options['pageParameterName'], 1)/*page number*/,
            $this->getRequest()->query->get($options['maxItemParameterName'], 10)/*limit per page*/ ,
            $options
        );

        return $pagination;
    }


    public function getRole($role)
    {
        $role = $this->getEntityManager()->getRepository('VMPVideoAppBundle:Role')->findOneBy(array('role' => $role));
        if(!$role) {
            $role = new \Surge\PeerPlatformBundle\Entity\Role($role);
            $this->persist($role);
        }

        return $role;
    }
}
