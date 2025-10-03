<?php
// Proxy PHP pour contourner les limitations CORS et gérer l'authentification
$api_url = 'http://api:5000/pozos/api/v1.0/get_student_ages';
$username = getenv('USERNAME') ?: 'toto';
$password = getenv('PASSWORD') ?: 'python';

// Initialiser cURL
$ch = curl_init();

// Configurer les options cURL
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

// Désactiver la vérification SSL (pour le développement seulement)
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

// Exécuter la requête
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Vérifier les erreurs cURL
if (curl_error($ch)) {
    http_response_code(500);
    echo json_encode(['error' => 'CURL Error: ' . curl_error($ch)]);
    curl_close($ch);
    exit;
}

curl_close($ch);

// Définir le header Content-Type
header('Content-Type: application/json');

// Retourner le code HTTP original de l'API
http_response_code($http_code);

// Retourner la réponse de l'API
echo $response;
