<?php

namespace DiskominfotikBandaAceh\EsignBsrePhp;

class EsignBsreResponse
{
    private $status;
    private $errors;
    private $data;
    private $response;
    private const STATUS_OK = 200;

    public function __construct($response)
    {
        $this->response = $response;

        $this->setStatus();
        $this->setErrors();
        $this->setData();
    }

    private function setStatus(): void
    {
        $this->status = $this->response->status();
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
    public function setErrors(): void
    {
        if ($this->status != self::STATUS_OK){
            $this->errors = json_decode($this->response->body())->error;
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
    public function setData(): void
    {
        if ($this->status == self::STATUS_OK){
            $this->data = $this->response->body();
        }
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
