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
use Symfony\Component\HttpFoundation\SessionStorage\ArraySessionStorage;

class ArraySessionStorageTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * initialize test
	 */
	public function setUp()
	{
		$this->session = new Session(new ArraySessionStorage(), array());
	}
	
	/**
	 * session storage should be able to store and retrieve values
	 * 
	 * @test
	 */
	public function shouldHandleValues()
	{
        $this->assertFalse($this->session->has('foo'));
		$this->session->set('foo', 'bar');
		$this->assertEquals('bar', $this->session->get('foo'));
		$this->assertTrue($this->session->has('foo'));
		$this->session->invalidate();
        $this->assertFalse($this->session->has('foo'));
	}
}
