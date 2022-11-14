<?php

namespace DiskominfotikBandaAceh\ESignBsrePhp;

use GuzzleHttp\Client as GuzzleClient;

class ESignBsre
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
        try {
            $response = $this->http->request('POST', "{$this->getBaseUrl()}/api/sign/pdf", [
                'auth' => $this->getAuth(),
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => $this->file,
                        'filename' => $this->fileName
                    ],
                    [
                        'name'     => 'nik',
                        'contents' => $nik,
                    ],
                    [
                        'name'     => 'passphrase',
                        'contents' => $passphrase,
                    ],
                    [
                        'name'     => 'tampilan',
                        'contents' => $this->view,
                    ],
                ],
            ]);
        }catch (\Exception $e) {
            $response = $e->getResponse();
        }

        return new ESignBsreResponse($response);
    }

    public function verification()
    {
        try {
            $response = $this->http->request('POST', "{$this->baseUrl}/api/sign/verify", [
                'auth' => $this->getAuth(),
                'multipart' => [
                    [
                        'name' => 'signed_file',
                        'contents' => $this->file,
                        'filename' => $this->fileName
                    ],
                ]
            ]);
        }catch (\Exception $e) {
            $response = $e->getResponse();
        }

        return new ESignBsreResponse($response);
    }

    private function getAuth(){
        return [$this->username, $this->password];
    }

    private function getBaseUrl(){
        $url = parse_url($this->baseUrl);

        return $url['scheme'] . '://' . $url['host'];
    }
}
