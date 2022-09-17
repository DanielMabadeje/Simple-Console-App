<?php
namespace George\ConsoleApp\Interfaces;


interface DomainInterface{

    public function __construct();
    
    public function post();

    public function get();

}