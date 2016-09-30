# FlatConfig
FlatConfig is a lightweight flat file configuration management PHP class. It uses JSON and file storage to store configuration data. The code is well commented so here I just provided some basic usage example. For brief description please explore the code <3

***NOTE: Don't forget to protect your configurtion file from direct access!***

### How to use this thing?

To use FlatConfig, we need to create an instance first with the path to the configuration file. File will be created automaticly if doesn't exist.

```php
$configFile = __DIR__ .'/config.json';
use mirazmac\FlatConfig;
// Create a new instance
$config = New FlatConfig($configFile);
```

### Add some data

```php
$config->add('name', 'Miraz');
$config->add('url', 'https://mirazmac.info');
$config->add('comment', 'Hmm! Looking great watson!');
```

### Update data

```php
$config->update('name', 'Miraz Mac');
```

### Delete data

```php
$config->delete('url');
```

### Retrieve the whole config array

```php
var_dump($config->getAll());
```

### Get a single value by its key

```php
$name = $config->get('name');
echo $name;
```

Thats all folks!