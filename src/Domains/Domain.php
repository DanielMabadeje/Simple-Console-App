<?php 
namespace George\ConsoleApp\Domains;

// use GuzzleHttp\Client;
// guzzlehttp/guzzle
// use GuzzleHttp\Exception\GuzzleException;

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
        $this->client = new GuzzleHttp\Client();
        // $this->client = n();
    }
    

    public function get()
    {
        try{
            $response = $this->client->request('GET', $this->generateEndpoint(), [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'authorization' => $this->personal_Access_token,
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
        try{
            $response = $this->client->request('POST', $this->generateEndpoint(), [
                'body' => $this->params,
                'headers' => [
                    'Accept' => 'application/vnd.github+json',
                    'Content-Type' => 'application/json',
                    'authorization' => $this->personal_Access_token,
                ],
            ]);
    
            return $response->getBody()->getContents();
        }
        catch (GuzzleException $e) {
            return ["status"=>false, "message" => "Unable to Create Account: $e"];
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
