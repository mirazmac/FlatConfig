<?php

namespace mirazmac;

use PHPUnit\Framework\TestCase;

class FlatConfigTest extends TestCase
{
    protected $flatConfig;
    protected $emptyFlatConfig;
    protected $nonExistedConfFile;
    protected $confFilePath;
    protected $nonEmptyConfFilePath;

    protected function setUp()
    {
        $this->nonExistedConfFile = __DIR__.'/non_existed.conf';
        $this->confFilePath = __DIR__.'/example.conf';
        $this->nonEmptyConfFilePath = __DIR__.'/non_empty.conf';
        @touch($this->confFilePath);
        $this->flatConfig = new FlatConfig($this->confFilePath);
        $this->emptyFlatConfig = new FlatConfig($this->nonEmptyConfFilePath);
    }

    protected function tearDown()
    {
        @unlink($this->confFilePath);
        @unlink($this->emptyFlatConfig);
        @unlink($this->nonExistedConfFile);
        $this->flatConfig = null;
    }

    public function testAdd()
    {
        $this::assertTrue($this->flatConfig->add('key', 'value'));
    }

    public function testUpdateWithKeyIsNotExisted()
    {
        $this::assertFalse($this->flatConfig->update('not_found_key', 'value'));
    }

    public function testUpdateWithKeyIsNotExistedAndForcedMode()
    {
        $this::assertTrue($this->flatConfig->update('not_found_key', 'value', true));
    }

    public function testUpdate()
    {
        $this->flatConfig->add('key', 'value');
        $this::assertTrue($this->flatConfig->update('key', 'value1'));
    }

    public function testDelete()
    {
        $this->flatConfig->add('key', 'value');
        $this::assertTrue($this->flatConfig->delete('key'));
    }

    public function testDeleteWithKeyIsNotExisted()
    {
        $this->flatConfig->add('key', 'value');
        $this::assertFalse($this->flatConfig->delete('not_found_key'));
    }

    public function testGetWithKeyIsNotExisted()
    {
        $this::assertSame('', $this->flatConfig->get('not_found_key'));
    }

    public function testGet()
    {
        $this->flatConfig->add('key', 'value');
        $this::assertSame('value', $this->flatConfig->get('key'));
    }

    public function testGetAll()
    {
        $this->flatConfig->add('key', 'value');
        $result = $this->flatConfig->getAll();
        $this::assertInternalType('array', $result);
        $this::assertSame('value', $result['key']);
    }

    public function testReadConfigFileWithFileIsNotExisted()
    {
        $nonExistedFlatConfig = new FlatConfig($this->nonExistedConfFile);
        $this->assertInstanceOf('mirazmac\FlatConfig', $nonExistedFlatConfig);
    }

    public function testReadConfigFileWithEmptyFileName()
    {
        $this->setExpectedException('\Exception');
        $flatConfig = new FlatConfig('');
    }

    public function testWriteConfigFileWithEmptyFileName()
    {
        $this->setExpectedException('\Exception');
        $this->flatConfig->configFile = '';
        $this->flatConfig->add('key', 'value');
    }
}
