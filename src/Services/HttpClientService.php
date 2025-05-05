<?php

namespace Simonking\Php\Services;

use GuzzleHttp\Client;

class HttpClientService 
{
    private static $clients = [];
    
    /**
     * Get client for a specific URL
     * Client instances are reused for the same domain+scheme+port
     */
    public static function getClient(string $url): Client 
    {
        $baseUrl = self::extractBaseUrl($url);
        
        if (!isset(self::$clients[$baseUrl])) {
            self::$clients[$baseUrl] = new Client([
                'base_uri' => $baseUrl,
                'timeout' => 10,
                'http_errors' => false,
                'headers' => [
                    'User-Agent' => 'XKPHP/1.0',
                    'Accept' => 'application/json',
                ],
            ]);
        }
        
        return self::$clients[$baseUrl];
    }
    
    /**
     * Extract the base URL (scheme + host + port) from a full URL
     *
     * @param string $url The full URL
     * @return string The base URL (e.g., "https://example.com:8080/")
     * @throws \InvalidArgumentException If the URL is invalid
     */
    private static function extractBaseUrl(string $url): string
    {
        $parsedUrl = parse_url($url);
        
        if (!$parsedUrl || !isset($parsedUrl['host'])) {
            throw new \InvalidArgumentException("Invalid URL provided: $url");
        }
        
        // Build the base domain with scheme, host and optional port
        $scheme = $parsedUrl['scheme'] ?? 'https';
        $host = $parsedUrl['host'];
        $port = isset($parsedUrl['port']) ? ":{$parsedUrl['port']}" : '';
        
        return "$scheme://$host$port/";
    }
    
    /**
     * Clear all clients (useful for testing)
     */
    public static function clearClients(): void
    {
        self::$clients = [];
    }
    
    /**
     * Get information about current clients for debugging
     */
    public static function getClientInfo(): array
    {
        return array_keys(self::$clients);
    }
}