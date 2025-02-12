<?php

return [
    'paths' => ['api/*'], // sadece api isteklerine CORS kısıtlaması uygula
    'allowed_methods' => ['*'], // Tüm HTTP metodlarını izin ver
    'allowed_origins' => ['*'], // Tüm originlere izin ver
    'allowed_headers' => ['*'], // Tüm başlıklar için izin ver
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
    
    
];
