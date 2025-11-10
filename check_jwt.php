<?php

$jwt = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InJidGZ3eG95Z3h1cHJhcm92YnRwIiwicm9sZSI6InNlcnZpY2Vfcm9sZSIsImlhdCI6MTc2MjYxODQ2NSwiZXhwIjoyMDc4MTk0NDY1fQ.eoxHjZ7TBAKsa0Sq0zaaXKu5tLBM4JIhvRHAItnpbKU';

$parts = explode('.', $jwt);
$payload = json_decode(base64_decode($parts[1]), true);

echo "=== SUPABASE SERVICE ROLE KEY ANALYSIS ===" . PHP_EOL . PHP_EOL;

echo "Role: " . $payload['role'] . PHP_EOL;
echo "Project Ref: " . $payload['ref'] . PHP_EOL;
echo "Issuer: " . $payload['iss'] . PHP_EOL . PHP_EOL;

echo "Issued At (iat): " . date('Y-m-d H:i:s', $payload['iat']) . " (timestamp: " . $payload['iat'] . ")" . PHP_EOL;
echo "Expires (exp): " . date('Y-m-d H:i:s', $payload['exp']) . " (timestamp: " . $payload['exp'] . ")" . PHP_EOL;
echo "Current Time: " . date('Y-m-d H:i:s') . " (timestamp: " . time() . ")" . PHP_EOL . PHP_EOL;

// Check validity
$now = time();
$isNotYetValid = $payload['iat'] > $now;
$isExpired = $payload['exp'] < $now;
$isValid = !$isNotYetValid && !$isExpired && $payload['role'] === 'service_role';

if ($isNotYetValid) {
    echo "❌ KEY NOT YET VALID: Issued-at date is in the FUTURE!" . PHP_EOL;
    echo "   The key says it was issued on " . date('Y-m-d', $payload['iat']) . " but today is " . date('Y-m-d') . PHP_EOL;
} elseif ($isExpired) {
    echo "❌ KEY EXPIRED: The key expired on " . date('Y-m-d', $payload['exp']) . PHP_EOL;
} elseif ($payload['role'] !== 'service_role') {
    echo "❌ WRONG KEY TYPE: This is a '" . $payload['role'] . "' key, not a service_role key!" . PHP_EOL;
} else {
    echo "✅ KEY IS VALID!" . PHP_EOL;
    echo "   - Correct role: service_role" . PHP_EOL;
    echo "   - Valid from: " . date('Y-m-d', $payload['iat']) . PHP_EOL;
    echo "   - Valid until: " . date('Y-m-d', $payload['exp']) . PHP_EOL;
}

echo PHP_EOL;
echo "Key length: " . strlen($jwt) . " characters" . PHP_EOL;
echo "First 40 chars: " . substr($jwt, 0, 40) . "..." . PHP_EOL;
