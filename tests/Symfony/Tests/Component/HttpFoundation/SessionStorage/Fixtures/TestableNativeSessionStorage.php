<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Tests\Component\HttpFoundation\SessionStorage\Fixtures;

use Symfony\Component\HttpFoundation\SessionStorage\NativeSessionStorage;

class TestableNativeSessionStorage extends NativeSessionStorage
{
	public function start()
	{
        if (self::$sessionStarted) {
            return;
        }

        session_set_cookie_params(
            $this->options['lifetime'],
            $this->options['path'],
            $this->options['domain'],
            $this->options['secure'],
            $this->options['httponly']
        );

        // disable native cache limiter as this is managed by HeaderBag directly
        session_cache_limiter(false);

        if (!ini_get('session.use_cookies') && $this->options['id'] && $this->options['id'] != session_id()) {
            session_id($this->options['id']);
        }

        $_SESSION = array();

        self::$sessionStarted = true;
	}
	
    public function regenerate($destroy = false)
    {
    	if ($destroy) {
    		$_SESSION = array();
    	}
        self::$sessionIdRegenerated = true;
    }
}
