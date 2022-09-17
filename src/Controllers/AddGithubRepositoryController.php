<?php

namespace George\ConsoleApp\Controllers;

use George\ConsoleApp\Domains\GithubDomain;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AddGithubRepositoryController extends Controller
{

    public $required;
    public $domain;

    public function __construct()
    {
        $this->required=[
            'name'=>'required',
            'token'=>'required',
        ];

        $this->domain=new GithubDomain;
    }
    public function addRepository($data)
    {   
        $empty=$this->checkIfEmpty($data, $this->required);
        if ($empty) {
            return $this->fail($empty);
        }
        $repo=$this->domain->addRepo($data, $data['token']);
        if ($this->domain->error) {
            return $this->fail($this->domain->error);
        }
        return $this->success($repo);
    }
}