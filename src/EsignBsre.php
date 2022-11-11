<?php

namespace DiskominfotikBandaAceh\EsignBsrePhp;

use GuzzleHttp\Client as GuzzleClient;

class EsignBsre
{
    private $http;
    private $baseUrl;
    private $username;
    private $password;
    private $file;
    private $fileName;
    private $view = 'invisible';

    public function __construct($baseUrl, $username, $password){
        $this->baseUrl = $baseUrl;

        $this->http = new GuzzleClient();
        $this->username = $username;
        $this->password = $password;
    }

    public function setFile($file, $fileName){
        $this->file = $file;
        $this->fileName = $fileName;

        return $this;
    }

    public function sign($nik, $passphrase)
    {
        $response = $this->http->request('POST', "{$this->baseUrl}/api/sign/pdf", [
            'auth' => [$this->username, $this->password],
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => $this->file,
                    'filename' => $this->fileName
                ],
            ],
            'form_params' => [
                'nik' => $nik,
                'passphrase' => $passphrase,
                'tampilan' => $this->view,
            ]
        ]);

        return new ESignBSreResponse($response);
    }

    public function verification()
    {
        $response = $this->http->request('POST', "{$this->baseUrl}/api/sign/verify", [
            'auth' => [$this->username, $this->password],
            'multipart' => [
                [
                    'name'     => 'signed_file',
                    'contents' => $this->file,
                    'filename' => $this->fileName
                ],
            ]
        ]);

        return new ESignBSreResponse($response);
    }
}
