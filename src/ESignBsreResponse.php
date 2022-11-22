<?php

namespace DiskominfotikBandaAceh\ESignBsrePhp;

class ESignBsreResponse
{
    private $status;
    private $errors;
    private $data;
    private $response;
    private const STATUS_OK = 200;

    public function __construct($response)
    {
        $this->setFromResponse($response);
    }

    public function setFromResponse($response){
        $this->response = $response;
        $this->setStatusFromResponse();
        $this->setDataFromResponse();
        $this->setErrorsFromResponse();

        return $this;
    }

    private function setStatusFromResponse(): void
    {
        $this->status = $this->response->getStatusCode();
    }

    /**
     * @return mixed
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param mixed $errors
     */
    public function setErrorsFromResponse(): void
    {
        if ($this->isFailed()){
            $responseBody = json_decode($this->response->getBody()->getContents());

            $this->errors = $responseBody->message ?? $responseBody->error;
        }
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param mixed $data
     */
    public function setDataFromResponse(): void
    {
        if ($this->isSuccess()){
            if (strpos(strtolower(implode(" ", $this->response->getHeader('Content-Type'))), strtolower('application/json')) !== false)
                $this->data = json_decode($this->response->getBody()->getContents());
            else
                $this->data = $this->response->getBody()->getContents();
        }
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    private function isSuccess(){
        return $this->status == self::STATUS_OK;
    }

    private function isFailed(){
        return $this->status != self::STATUS_OK;
    }
}
