<?php
/**
* FlatConfig
*
* Lightweight key-value based flat file configuration management PHP class.
* @author       Miraz Mac <mirazmac@gmail.com>
* @version 1.0  NewBorn
* @link http://mirazmac.info Author Homepage
* @license LICENSE The MIT License
*/

namespace mirazmac;

class FlatConfig
{
    /** @var array The configuration array */
    public $config = array();

    /** @var string Path to the config file */
    public $configFile;

    /**
     * Class constructor
     *
     * @param string $configFile Full path to file where the configuration will be stored
     *                           Will be created if doesn't exist
     */
    public function __construct($configFile)
    {
        $this->configFile = $configFile;
        $this->readConfigFile();
    }

    /**
     * Adds a key to Config file ( will be overwritten )
     *
     * @param mixed $key   The key
     * @param mixed $value And the key value
     * @return boolean
     */
    public function add($key, $value = '')
    {
        $this->config[$key] = $value;
        // Update changes in the config file
        return $this->writeConfigFile();
    }

    /**
     * Update a existing key
     *
     * @param mixed $key   The key
     * @param mixed $value And the key value
     * @param boolean $force Allows to to add the key to config file if it doesn't exist
     * @return boolean
     */
    public function update($key, $value = '', $force = false)
    {
        // Since we are updating the data, if the key doesnt exist,
        // and we are not being forced, abort!
        if (!isset($this->config[$key]) && !$force)
            return false;
        // Update key value
        $this->config[$key] = $value;
        // Update changes in the config file
        return $this->writeConfigFile();
    }

    /**
     * Delete an existing key
     *
     * @param mixed $key   The key
     * @return boolean
     */
    public function delete($key)
    {
        // Since we are removing the data, if the key doesn't exist, abort!
        if (!isset($this->config[$key]))
            return false;
        // Remove the key from array
        unset($this->config[$key]);
        // Update changes in the config file
        return $this->writeConfigFile();
    }

    /**
     * Retrieve a key value
     *
     * @param  string $key     The config key
     * @param  string $default Fall back value, will be used if key doesn't exist
     * @return mixed
     */
    public function get($key, $default = '')
    {
        return isset($this->config[$key]) ? $this->config[$key] : $default;
    }

    /**
     * Retrieve all configuration as array
     *
     * @return array
     */
    public function getAll()
    {
        return $this->config;
    }

    /**
     * Read data from config file and store in variable
     *
     * @access private
     * @return
     */
    private function readConfigFile()
    {
        if ($this->configFile === '')
            throw new \Exception('Filename cannot be empty');
        // You already know what this code does -_-
        if (!file_exists($this->configFile))
            file_put_contents($this->configFile, '');

        // Grab the data, decode, store in variable
        $data = json_decode(file_get_contents($this->configFile), true);

        if(is_array($data) && !empty($data)) {
            $this->config = $data;
        }
    }

    /**
     * Update the data to the config file
     *
     * @throws \Exception If failed to write
     * @access private
     * @return boolean
     */
    private function writeConfigFile()
    {
        if (!@file_put_contents($this->configFile, json_encode($this->config), LOCK_EX)) {
            throw new \Exception('Failed to write data to the config file. Make sure the file is writable.');
        }
        return true;
    }
}
