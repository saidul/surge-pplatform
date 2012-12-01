<?php

namespace Surge\PeerPlatformBundle\DataFixtures\ORM;

use Surge\PeerPlatformBundle\Entity\User;
use Surge\PeerPlatformBundle\Entity\File;
use Surge\PeerPlatformBundle\Entity\SiteOption;
use Surge\PeerPlatformBundle\Service\LoremIpsumGenerator;
use Surge\PeerPlatformBundle\Entity\Role;

/**
 * Description of StaticData
 *
 */
class LoadStaticData extends \Doctrine\Common\DataFixtures\AbstractFixture implements \Doctrine\Common\DataFixtures\OrderedFixtureInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    private $users = array();

    private $tree;

    private $dataDir;
    private $assetDir;

    /** @var LoremIpsumGenerator */
    private $wordGenerator;

    private $ROLE_SUPER_ADMIN;
    private $ROLE_ADMIN;
    private $ROLE_USER;

    private $lastnames = array(
        "M" => array("Rahman", "Hoque", "Uddin", "Islam", "Chowdhuri", "Ali", "Hossain", "Ahmed", "Mia"),
        "F" => array("Khatun", "Begum", "Akter", "Islam", "Madam", "Banu", "Pagli", "Necha", "Buri")
    );

    private function getRandomWord($count, $type='plain', $capitalize=true)
    {
        $str = $this->wordGenerator->getContent($count,$type,false);
        return $capitalize ? ucfirst($str) : $str;
    }

    public function persist($obj)
    {
        $obj->setCreatedBy($this->user);
        $this->em->persist($obj);
    }

    private function prepareFile($source, $destination, $fakeIfWindows = false)
    {
        if(file_exists($destination)) return;
        $destDir = dirname($destination);
        if(!file_exists($destDir)) mkdir($destDir,0777, true);
        if(stristr(PHP_OS, 'win')){
            if ($fakeIfWindows) touch($destination);
            else copy($source, $destination);
        }else{
            symlink ( $source, $destination );
        }
    }

    public function load(\Doctrine\Common\Persistence\ObjectManager $manager)
    {
        $this->dataDir = __DIR__."/../../../../../data";
        $this->assetDir = __DIR__."/../files";

        $this->wordGenerator = new LoremIpsumGenerator();

        $this->em = $manager;
        $this->initRoles();
        $this->loadUsers();

        $this->em->flush();
    }

    protected function getRandomImageDocument(){
        $fileName = 'image-0'.rand(1,5).'.jpg';
        $this->prepareFile($this->assetDir."/$fileName" , $this->dataDir."/".$fileName);

        $image = new File();
        $image->setPath($fileName);

        return $image;
    }

    private function getRandomDate()
    {
        $day = rand(2, 30);
        return new \DateTime("-{$day} days");
    }

    public function initRoles(){

        $this->ROLE_SUPER_ADMIN = new Role('ROLE_SUPER_ADMIN');
        $this->ROLE_ADMIN = new Role('ROLE_ADMIN');
        $this->ROLE_USER = new ROle('ROLE_USER');

        $em = $this->em;
        $em->persist($this->ROLE_SUPER_ADMIN);
        $em->persist($this->ROLE_ADMIN);
        $em->persist($this->ROLE_USER);

        $em->flush();
    }

    /**
     * preloads user
     */
    public function loadUsers()
    {
        $em = $this->em;

        $gender = array("M", "F");



/*        $user = new User();
        $user->setUsername('system');
        $user->setPlainPassword(md5(uniqid()));
        $user->setEmail('system@familytree.com');
        $user->setEnabled(false);
        $user->setLocked(true);
        $user->addRole($this->ROLE_SUPER_ADMIN);
        $user->setConfirmationToken(null);
        $user->setGender('male');

        $em->persist($user);*/


        $user = new User();
        $user->setGender($gender[rand(0, 1)]);
        $user->setFirstName(substr($this->getRandomWord(1), 0, -2));
        $user->setLastName($this->lastnames[$user->getGender()][rand(0, count($this->lastnames[$user->getGender()])-1)]);
        $user->setUsername('admin');
        $user->setPlainPassword('admin');
        $user->setEmail('murubbi@hackathonbd.com');
        $user->setEnabled(true);
        $user->addRole($this->ROLE_SUPER_ADMIN);
        $user->setConfirmationToken(null);

        $user->addRole($this->ROLE_ADMIN);

        $em->persist($user);
        $this->users[] = $user;


        //adding users
        for ($i = 1; $i <= 20; $i++) {
            $user = new User();
            $user->setUsername("user{$i}");
            $user->setPlainPassword("user{$i}");
            $user->setEmail("user{$i}@hackathonbd.com");
            $user->setEnabled(true);
            $user->setSuperAdmin(false);
            $user->setConfirmationToken(null);
            $user->addRole($this->ROLE_USER);
            $user->setGender($gender[rand(0, 1)]);
            $user->setFirstName(substr($this->getRandomWord(1), 0, -2));
            $user->setLastName($this->lastnames[$user->getGender()][rand(0, count($this->lastnames[$user->getGender()])-1)]);

            $em->persist($user);
            $this->addReference("user-$i", $user);
            $this->users[] = $user;
        }

        $this->em->flush();
    }



    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1;
    }
}

?>
