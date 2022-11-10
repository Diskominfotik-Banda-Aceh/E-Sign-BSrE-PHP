<?php

namespace DiskominfotikBandaAceh\EsignBsrePhp;

class EsignBsrePhp
{
    private $http;
    private $url;

    public function __construct($url=null, $username=null, $password=null){
        $this->url = $url;
        $this->http = Http::withBasicAuth($username, $password);
    }

    public function sign($var = null)
    {
        
    }

    public function verification($var = null)
    {
        
    }
}
