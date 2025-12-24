<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Google extends BaseConfig
{
    /**
     * Google OAuth Client ID
     * 
     * Get this from Google Cloud Console:
     * 1. Go to https://console.cloud.google.com/
     * 2. Create a new project or select existing one
     * 3. Go to APIs & Services > Credentials > Create Credentials > OAuth client ID
     * 4. Select Web application
     * 5. Add authorized JavaScript origins:
     *    - http://localhost:8080 (development)
     *    - https://yourdomain.com (production)
     * 6. Copy the Client ID here
     * 
     * Note: Google Identity Services tidak memerlukan API khusus untuk di-enable.
     * Hanya perlu OAuth 2.0 Client ID.
     */
    public string $clientId = '21903319112-05ri5jqpq60aaov623vutch9j64fr8n2.apps.googleusercontent.com';
    
    /**
     * Google Maps Embed API Key (Optional - untuk peta di halaman profil)
     * 
     * Jika ingin menggunakan fitur peta:
     * 1. Enable "Maps Embed API" di APIs & Services > Library
     * 2. Buat API Key di APIs & Services > Credentials > Create Credentials > API Key
     * 3. Paste API Key di sini
     * 
     * Maps Embed API GRATIS tanpa batas.
     */
    public string $mapsApiKey = 'AIzaSyC55F_qKKV8WREdk8Wv-o6HMvfFvEpst48';

    /**
     * Google OAuth Client Secret (optional for Google Identity Services)
     */
    public string $clientSecret = '';
}

