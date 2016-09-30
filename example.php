<?php
require_once __DIR__ .'/src/FlatConfig.php';
$configFile = __DIR__ .'/config.json';
use mirazmac\FlatConfig;

// Create a new instance
$config = New FlatConfig($configFile);

// Add some values
$config->add('name', 'Miraz');
$config->add('url', 'https://mirazmac.info');
$config->add('comment', 'Hmm! Looking great watson!');
$config->add('duplicate', 'Hmm! Looking great watson!');

// Update a value
$config->update('name', 'Miraz Mac');

// Delete a value
$config->delete('duplicate');

// Print a single key
echo $config->get('name');

echo '<hr/>';

// Alias of FlatConfig::get()
$config->_e('url');

echo '<hr/>';
// Retrieve the whole array
var_dump($config->getAll());