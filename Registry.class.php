<?php

class Registry
{
    private $ip_address;
    private $mac_address;
    private $token;
    private $short_id;
    private $machine_name;

    private $SALT="JASON.KIM.CLOUD";

    /**
     * @param mixed $ip_address
     */
    public function setIpAddress($ip_address)
    {
        $this->ip_address = Utils::Clean($ip_address);
    }

    /**
     * @param mixed $mac_address
     */
    public function setMacAddress($mac_address)
    {
        $this->mac_address = Utils::Clean($mac_address);
    }

    /**
     * @param mixed $machine_name
     */
    public function setMachineName($machine_name)
    {
        $this->machine_name = Utils::Clean($machine_name);
    }

    private function generateToken(){
        $token_raw="*#*#".$this->SALT.$this->ip_address."|".$this->SALT.$this->mac_address."|".$this->SALT.$this->machine_name."#*#*";
        $this->token=base64_encode(sha1(md5($token_raw)));
    }

    private function generateShortID(){
        //Mac 40-B0-76-62-34-16
        $mac_array=explode("-",$this->mac_address);
        $mac_appendix=$mac_array[4].$mac_array[5];
        $this->short_id=$this->machine_name."[".$mac_appendix."]";
    }
}