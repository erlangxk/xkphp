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
        $this->jsonPlaceholderClient = HttpClientService::getClient('http://mockserver:3000/');
    }
    
    /**
     * Fetch posts from JSONPlaceholder API
     */
    public function getUsers()
    {
        try {
            $response = $this->jsonPlaceholderClient->get('users');
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
                    'message' => 'Failed to fetch users',
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
    public function getUser($id)
    {
        try {
            $response = $this->jsonPlaceholderClient->get("users/{$id}");
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
                    'message' => 'User not found'
                ], 404);
            } else {
                Flight::json([
                    'success' => false,
                    'message' => 'Failed to fetch user',
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