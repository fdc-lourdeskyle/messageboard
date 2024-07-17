<?php
// Include CakePHP's bootstrap
require 'app/Config/bootstrap.php';

// Instantiate a CakePHP Database connection
ConnectionManager::create('default', $config['default']);

// Test connection
try {
    $db = ConnectionManager::getDataSource('default');
    $connected = $db->isConnected();
    echo "Connected to database: " . ($connected ? 'Yes' : 'No');
} catch (Exception $e) {
    echo "Error connecting to database: " . $e->getMessage();
}
?>
