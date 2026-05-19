<?php
const SUBSCRIPTIONS_FILE = './storage/subscriptions.ser';
const LOG_FILE = './storage/log.txt';

function allSubscriptions() {
    return file_exists(SUBSCRIPTIONS_FILE) ? unserialize(file_get_contents(SUBSCRIPTIONS_FILE)) : [];
}
function addSubscription($params) {
    $subscriptions = allSubscriptions();
    $subscriptions[] = $params;
    file_put_contents(SUBSCRIPTIONS_FILE, serialize($subscriptions));
}
function logMessage($message) {
    $message = mb_convert_encoding($message, 'UTF-8', 'auto');
    file_put_contents(LOG_FILE, date('Y-m-d H:i:s') . " - " . $message . PHP_EOL, FILE_APPEND | LOCK_EX);
}
?>