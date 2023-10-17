<?php

namespace DiskominfotikBandaAceh\ESignBsrePhp;

use GuzzleHttp\Client as GuzzleClient;
use PhpParser\Node\Stmt\TryCatch;

class ESignBsre
{
    private $http;
    private $baseUrl;
    private $username;
    private $password;
    private $file;
    private $fileName;
    private $view = 'invisible';
    private $timeout;

    public function __construct($baseUrl, $username, $password, $timeout=30){
        $this->baseUrl = $baseUrl;

        $this->http = new GuzzleClient();
        $this->username = $username;
        $this->password = $password;
        $this->timeout = $timeout; 
    }

    public function setFile($file, $fileName){
        $this->file = $file;
        $this->fileName = $fileName;

        return $this;
    }

    public function setTimeout($timeout){
        $this->timeout = $timeout;

        return $this;
    }

    public function sign($nik, $passphrase)
    {
        try {
            $response = $this->http->request('POST', "{$this->getBaseUrl()}/api/sign/pdf", [
                'auth' => $this->getAuth(),
                'timeout' => $this->timeout,
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
        }catch(\GuzzleHttp\Exception\ConnectException $e){
            return new ESignBsreResponse($e);
        } catch (\Exception $e) {
            $response = $e->getResponse();
        }

        return (new ESignBsreResponse())->setFromResponse($response); 
    }

    public function verification()
    {
        try {
            $response = $this->http->request('POST', "{$this->getBaseUrl()}/api/sign/verify", [
                'auth' => $this->getAuth(),
                'timeout' => $this->timeout,
                'multipart' => [
                    [
                        'name' => 'signed_file',
                        'contents' => $this->file,
                        'filename' => $this->fileName
                    ],
                ]
            ]);
        }catch(\GuzzleHttp\Exception\ConnectException $e){
            return new ESignBsreResponse($e);
        } catch (\Exception $e) {
            $response = $e->getResponse();
        }

        return (new ESignBsreResponse())->setFromResponse($response); 
    }

    public function statusUser($nik) {
        try {
            $response = $this->http->request('GET', "{$this->getBaseUrl()}/api/user/status/$nik", [
                'auth' => $this->getAuth(),
                'timeout' => $this->timeout,
            ]);
        } catch(\GuzzleHttp\Exception\ConnectException $e){
            return (new ESignBsreResponse())->setFromExeption($e, ESignBsreResponse::STATUS_TIMEOUT);
        } catch (\Exception $e) {
            $response = $e->getResponse();
        }

        return (new ESignBsreResponse())->setFromResponse($response); 
    }

    private function getAuth(){
        return [$this->username, $this->password];
    }

    private function getBaseUrl(){
        return rtrim($this->baseUrl, "/");
    }
}
