<?php

namespace phpbrowscap;

use phpbrowscap\Browscap;

/**
 * Browscap.ini parsing class with caching and update capabilities
 *
 * PHP version 5
 *
 * Copyright (c) 2006-2012 Jonathan Stoppani
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package    Browscap
 * @author     Vítor Brandão <noisebleed@noiselabs.org>
 * @copyright  Copyright (c) 2006-2012 Jonathan Stoppani
 * @version    1.0
 * @license    http://www.opensource.org/licenses/MIT MIT License
 * @link       https://github.com/GaretJax/phpbrowscap/
 */
class BrowscapTest extends TestCase
{
    public function testProxyAutoDetection()
    {
        $browscap = $this->createBrowscap();

        putenv('http_proxy=http://proxy.example.com:3128');
        putenv('https_proxy=http://proxy.example.com:3128');
        putenv('ftp_proxy=http://proxy.example.com:3128');

        $browscap->autodetectProxySettings();
        $options = $browscap->getStreamContextOptions();

        $this->assertEquals($options['http']['proxy'], 'tcp://proxy.example.com:3128');
        $this->assertTrue($options['http']['request_fulluri']);

        $this->assertEquals($options['https']['proxy'], 'tcp://proxy.example.com:3128');
        $this->assertTrue($options['https']['request_fulluri']);

        $this->assertEquals($options['ftp']['proxy'], 'tcp://proxy.example.com:3128');
        $this->assertTrue($options['ftp']['request_fulluri']);
    }

    public function testAddProxySettings()
    {
        $browscap = $this->createBrowscap();

        $browscap->addProxySettings('proxy.example.com', 3128, 'http');
        $options = $browscap->getStreamContextOptions();

        $this->assertEquals($options['http']['proxy'], 'tcp://proxy.example.com:3128');
        $this->assertTrue($options['http']['request_fulluri']);
    }

    public function testClearProxySettings()
    {
        $browscap = $this->createBrowscap();

        $browscap->addProxySettings('proxy.example.com', 3128, 'http');
        $options = $browscap->getStreamContextOptions();

        $this->assertEquals($options['http']['proxy'], 'tcp://proxy.example.com:3128');
        $this->assertTrue($options['http']['request_fulluri']);

        $clearedWrappers = $browscap->clearProxySettings();
        $options = $browscap->getStreamContextOptions();

        $this->assertEmpty($options);
        $this->assertEquals($clearedWrappers, array('http'));
    }

    public function testGetStreamContext()
    {
        $cacheDir = $this->createCacheDir();
        $browscap = new BrowscapForTest($cacheDir);

        $browscap->addProxySettings('proxy.example.com', 3128, 'http');

        $resource = $browscap->getStreamContext();

        $this->assertTrue(is_resource($resource));
    }
}

class BrowscapForTest extends Browscap
{
    public function getStreamContext($recreate = false)
    {
        return $this->_getStreamContext($recreate);
    }
}