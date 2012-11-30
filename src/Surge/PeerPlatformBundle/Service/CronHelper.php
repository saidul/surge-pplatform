<?php
namespace Surge\PeerPlatformBundle\Service;

class CronHelper {

    private $pid;

    public $lockDir;

    public $lockFileName;

    public function __construct($lockDir)
    {
        $this->lockDir = $lockDir;
        $this->lockFileName = 'console.lock';
    }

    private  function isRunning() {
        $pids = explode(PHP_EOL, `ps -e | awk '{print $1}'`);
        if(in_array($this->pid, $pids))
            return TRUE;
        return FALSE;
    }

    public  function lock() {

        $lock_file = $this->lockDir.$this->lockFileName;
        if(file_exists($lock_file)) {
            //return FALSE;

            // Is running?
            $this->pid = file_get_contents($lock_file);
            if(self::isRunning()) {
                //error_log("==".$this->pid."== Already in progress...");
                return FALSE;
            }
            else {
                //error_log("==".$this->pid."== Previous job died abruptly...");
            }
        }

        $this->pid = getmypid();
        file_put_contents($lock_file, $this->pid);
        //error_log("==".$this->pid."== Lock acquired, processing the job...");
        return $this->pid;
    }

    public  function unlock() {
        global $argv;

        $lock_file = $this->lockDir.$this->lockFileName;

        if(file_exists($lock_file))
            unlink($lock_file);

        //error_log("==".$this->pid."== Releasing lock...");
        return TRUE;
    }

}