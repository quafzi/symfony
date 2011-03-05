<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Tests\Component\HttpFoundation;

use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpFoundation\SessionStorage;
use Symfony\Tests\Component\HttpFoundation\SessionStorage\Fixtures\TestableNativeSessionStorage;

class NativeSessionStorageTest extends \PHPUnit_Framework_TestCase
{
    static protected $fixturesPath;

    static public function setUpBeforeClass()
    {
        self::$fixturesPath = __DIR__.'/Fixtures/';
        require_once self::$fixturesPath.'/TestableNativeSessionStorage.php';
    }
    
	public function setUp()
	{
        $this->session = new Session(
            new TestableNativeSessionStorage(),
            array()
        );
	}
	
	public function testGetValue()
	{
        $this->assertFalse($this->session->has('foo'));
        $this->assertEquals('nope', $this->session->get('foo', 'nope'));
        $this->session->set('foo', 'bar');
		$this->assertEquals('bar', $this->session->get('foo'));
		$this->assertTrue($this->session->has('foo'));
		$this->session->invalidate();
        $this->assertFalse($this->session->has('foo'));
	}
	
	public function testRemoveValue()
	{
        $this->assertFalse($this->session->has('foobar'));
        $this->session->set('foobar', 'foo');
        $this->assertTrue($this->session->has('foobar'));
        $this->assertEquals('foo', $this->session->get('foobar'));
		$this->session->remove('foobar');
        $this->assertFalse($this->session->has('foobar'));
	}
}