<?php

namespace George\ConsoleApp\Domains;

use George\ConsoleApp\Interfaces\DomainInterface;

class GithubDomain extends Domain implements DomainInterface
{
    public function __construct()
    {
        $this->url="https://api.github.com";
    }

    public function addRepo($params, $token)
    {

        unset($params['token']);
        $this->params=$params;
        $this->createRequestBag("/user/repos", $token);
        return $this->post();
    }

    public function getRepo($token)
    {
        $this->createRequestBag("/user/repos", $token);
        return $this->get();
    }

    public function createRequestBag($url, $token)
    {
        $this->route($url);
        $this->token($token);
    }
}
