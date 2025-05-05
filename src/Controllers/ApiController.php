<?php

namespace Simonking\Php\Controllers;

use Flight;
use GuzzleHttp\Exception\GuzzleException;
use Simonking\Php\Services\HttpClientService;

class ApiController
{
    private $jsonPlaceholderClient;
    
    public function __construct()
    {
        // Get a domain-specific client
        $this->jsonPlaceholderClient = HttpClientService::getClient('https://jsonplaceholder.typicode.com/');
    }
    
    /**
     * Fetch posts from JSONPlaceholder API
     */
    public function getPosts()
    {
        try {
            $response = $this->jsonPlaceholderClient->get('posts');
            $statusCode = $response->getStatusCode();
            
            if ($statusCode === 200) {
                $data = json_decode($response->getBody(), true);
                Flight::json([
                    'success' => true,
                    'data' => $data
                ]);
            } else {
                Flight::json([
                    'success' => false,
                    'message' => 'Failed to fetch posts',
                    'status' => $statusCode
                ], 500);
            }
        } catch (GuzzleException $e) {
            Flight::json([
                'success' => false,
                'message' => 'Error fetching data: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Fetch a specific post by ID
     */
    public function getPost($id)
    {
        try {
            $response = $this->jsonPlaceholderClient->get("posts/{$id}");
            $statusCode = $response->getStatusCode();
            
            if ($statusCode === 200) {
                $data = json_decode($response->getBody(), true);
                Flight::json([
                    'success' => true,
                    'data' => $data
                ]);
            } else if ($statusCode === 404) {
                Flight::json([
                    'success' => false,
                    'message' => 'Post not found'
                ], 404);
            } else {
                Flight::json([
                    'success' => false,
                    'message' => 'Failed to fetch post',
                    'status' => $statusCode
                ], 500);
            }
        } catch (GuzzleException $e) {
            Flight::json([
                'success' => false,
                'message' => 'Error fetching data: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Fetch weather data for a specific city
     */
    public function getWeatherData($city)
    {
        // Get a different domain-specific client
        $weatherClient = HttpClientService::getClient('https://api.weatherapi.com/v1/');
        
        try {
            $response = $weatherClient->get("current.json", [
                'query' => ['q' => $city, 'key' => 'your-api-key']
            ]);
            $statusCode = $response->getStatusCode();
            
            if ($statusCode === 200) {
                $data = json_decode($response->getBody(), true);
                Flight::json([
                    'success' => true,
                    'data' => $data
                ]);
            } else {
                Flight::json([
                    'success' => false,
                    'message' => 'Failed to fetch weather data',
                    'status' => $statusCode
                ], 500);
            }
        } catch (GuzzleException $e) {
            Flight::json([
                'success' => false,
                'message' => 'Error fetching data: ' . $e->getMessage()
            ], 500);
        }
    }
}