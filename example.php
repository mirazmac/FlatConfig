<?php
error_reporting(-1);
require_once __DIR__ .'/src/FlatConfig.php';
$configFile = __DIR__ .'/config.json';
use mirazmac\FlatConfig;

// Create a new instance
$config = New FlatConfig($configFile);

// Add some values
echo 'Adding some values:<br/>';
var_dump($config->add('name', 'Miraz'));
var_dump($config->add('url', 'https://mirazmac.info'));
var_dump($config->add('comment', 'Hmm! Looking great watson!'));
var_dump($config->add('duplicate', 'Hmm! Looking great watson!'));
var_dump($config->add('another', 'Hmm! Looking great watson!'));

echo '<hr/>Update a value:<br/>';
// Update a value
var_dump($config->update('name', 'Miraz Mac'));

echo '<hr/>Delete a Value<br/>';
// Delete a value
var_dump($config->delete('duplicate'));
echo '<hr/>Print a single key value:<br/>';
// Print a single key
echo var_dump($config->get('name'));

echo '<hr/>Retrieve the whole array:<br/>';
// Retrieve the whole array
var_dump($config->getAll());
