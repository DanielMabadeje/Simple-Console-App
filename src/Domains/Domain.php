<?php 
namespace George\ConsoleApp\Domains;

use GuzzleHttp\Client;
// guzzlehttp/guzzle
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp;

class Domain
{

    public $personal_Access_token;
    public $url;
    public $params;
    public $route;
    public $client;
    public $endpoint;
    public $error=false;
    public $response;

    public function __construct()
    {
        // $this->client = new Client();
    }
    

    public function get()
    {
        $client=new Client();
        try{
            $response = $client->request('GET', $this->generateEndpoint(), [
                'headers' => [
                    'Accept' => 'application/vnd.github+json',
                    'Content-Type' => "application/x-www-form-urlencoded",
                    'Authorization' => "Bearer ".$this->personal_Access_token,
                ],
            ]);
    
            return  $response->getBody()->getContents();
        }
        catch (GuzzleException $e) {
            return $this->error=["status"=>false, "message" => "Unable to Get Repositories: $e"];
        }
    }


    public function post()
    {

        $client=new Client();
        try{
            $response = $client->request('POST', $this->generateEndpoint(), [
                'body' => json_encode($this->params),
                'headers' => [
                    'Accept' => 'application/vnd.github+json',
                    'Content-Type' => "application/x-www-form-urlencoded",
                    'Authorization' => "Bearer ".$this->personal_Access_token,
                ],
            ]);
            
    
            return $response->getBody()->getContents();
        }
        catch (GuzzleException $e) {
            return $this->error=["status"=>false, "message" => "Unable to Create Account: $e"];
        }
    }

    public function generateEndpoint()
    {
        return $this->endpoint=$this->url.$this->route;
    }

    public function token($token)
    {
        return $this->personal_Access_token=$token;
    }

    public function route($route)
    {
        return $this->route=$route;
    }
  
}
