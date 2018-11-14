<?php
namespace Bud\Http;

class CurlRequest implements RequestInterface
{
    /**
     * @var null|resource
     */
    private $handle = null;

    /**
     * CurlRequest constructor.
     *
     * @param string $url
     */
    public function __construct($url) {
        $this->handle = curl_init($url);
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function setOption($name, $value) {
        curl_setopt($this->handle, $name, $value);
    }

    /**
     * @return mixed
     */
    public function execute() {
        // Set response data
        $result['response'] = curl_exec($this->handle);
        // Set response code
        $result['http_code'] = curl_getinfo($this->handle, CURLINFO_HTTP_CODE);
        $this->close();

        return $result;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getInfo($name) {
        return curl_getinfo($this->handle, $name);
    }

    public function close() {
        curl_close($this->handle);
    }
}