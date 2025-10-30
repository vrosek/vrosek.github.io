<?php
// Настройки
$counterFile = 'counter.txt';
$ipLogFile = 'ip_log.txt';

// Получаем текущий IP
$ip = $_SERVER['REMOTE_ADDR'];

// Читаем список IP
$ips = file_exists($ipLogFile) ? file($ipLogFile, FILE_IGNORE_NEW_LINES) : [];

// Если IP новый - увеличиваем счётчик
if (!in_array($ip, $ips)) {
    // Получаем текущее значение
    $count = file_exists($counterFile) ? (int)file_get_contents($counterFile) : 0;
    
    // Увеличиваем
    $count++;
    
    // Сохраняем
    file_put_contents($counterFile, $count);
    file_put_contents($ipLogFile, $ip.PHP_EOL, FILE_APPEND);
} else {
    // Просто читаем текущее значение
    $count = file_exists($counterFile) ? (int)file_get_contents($counterFile) : 0;
}

// Возвращаем результат
header('Content-Type: application/json');
echo json_encode(['views' => $count]);
?>