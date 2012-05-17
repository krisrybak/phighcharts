<?php
/**
 * Tests for the Phighchart\Options\Container class
 */

namespace Phighchart\Test\Options;

use Phighchart\Options\Container;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetType()
    {
        $options = new Container('optionsType');
        $this->assertSame('optionsType', $options->getType());
    }

    public function testSetGetOption()
    {
        $options = new Container('optionsType');
        $options->setOption('myKey', 'someValue');
        $this->assertTrue($options->getOptions() instanceof \StdClass);
        $this->assertSame('someValue', $options->getOptions()->myKey);
    }

    public function testMagicCalls()
    {
        $options = new Container('optionsType');
        $options->setRandomProperty(133);
        $options->setAnotherRandomProperty($stdClass = new \StdClass());
        $this->assertSame(133, $options->getOptions()->randomProperty);
        $this->assertSame($stdClass, $options->getOptions()->anotherRandomProperty);
    }
}