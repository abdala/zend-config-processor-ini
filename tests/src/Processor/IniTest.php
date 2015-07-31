<?php
/*
 * This file is part of the La package.
 *
 * (c) Abdala Cerqueira <abdala.cerqueira@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace La\Config\Test\Processor;

use Zend\Config\Config;
use Zend\Config\Reader\Ini as Reader;
use La\Config\Processor\Ini as Processor;
use Zend\Config\Processor\ProcessorInterface;
use Zend\Config\Exception;

class IniTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->reader    = new Reader();
        $this->processor = new Processor();
    }
    
    public function testDisplayErrosOn()
    {
        $config = new Config($this->reader->fromFile(__DIR__ . '/../../assets/test-on.ini'));

        $this->processor->process($config);
        
        $this->assertTrue((bool) ini_get('display_errors'));
    }
    
    public function testDisplayErrosOff()
    {
        $config = new Config($this->reader->fromFile(__DIR__ . '/../../assets/test-off.ini'));

        $this->processor->process($config);
        
        $this->assertFalse((bool) ini_get('display_errors'));
    }
}