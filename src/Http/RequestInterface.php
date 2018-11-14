<?php
namespace Bud\Http;

interface RequestInterface
{
    public function setOption($name, $value);
    public function execute();
    public function getInfo($name);
    public function close();
}