<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Fragment\Tests\FragmentRenderer;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ControllerReference;
use Symfony\Component\HttpKernel\Fragment\HIncludeFragmentRenderer;
use Symfony\Component\HttpKernel\UriSigner;

class HIncludeFragmentRendererTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        if (!class_exists('Symfony\Component\HttpFoundation\Request')) {
            $this->markTestSkipped('The "HttpFoundation" component is not available');
        }
    }

    /**
     * @expectedException \LogicException
     */
    public function testRenderExceptionWhenControllerAndNoSigner()
    {
        $strategy = new HIncludeFragmentRenderer();
        $strategy->render(new ControllerReference('main_controller', array(), array()), Request::create('/'));
    }

    public function testRenderWithControllerAndSigner()
    {
        $strategy = new HIncludeFragmentRenderer(null, new UriSigner('foo'));

        $this->assertEquals('<hx:include src="http://localhost/_fragment?_path=_format%3Dhtml%26_controller%3Dmain_controller&amp;_hash=VI25qJj8J0qveB3bGKPhsJtexKg%3D"></hx:include>', $strategy->render(new ControllerReference('main_controller', array(), array()), Request::create('/'))->getContent());
    }

    public function testRenderWithUri()
    {
        $strategy = new HIncludeFragmentRenderer();
        $this->assertEquals('<hx:include src="/foo"></hx:include>', $strategy->render('/foo', Request::create('/'))->getContent());

        $strategy = new HIncludeFragmentRenderer(null, new UriSigner('foo'));
        $this->assertEquals('<hx:include src="/foo"></hx:include>', $strategy->render('/foo', Request::create('/'))->getContent());
    }

    public function testRenderWhithDefault()
    {
        // only default
        $strategy = new HIncludeFragmentRenderer();
        $this->assertEquals('<hx:include src="/foo">default</hx:include>', $strategy->render('/foo', Request::create('/'), array('default' => 'default'))->getContent());

        // only global default
        $strategy = new HIncludeFragmentRenderer(null, null, 'global_default');
        $this->assertEquals('<hx:include src="/foo">global_default</hx:include>', $strategy->render('/foo', Request::create('/'), array())->getContent());

        // global default and default
        $strategy = new HIncludeFragmentRenderer(null, null, 'global_default');
        $this->assertEquals('<hx:include src="/foo">default</hx:include>', $strategy->render('/foo', Request::create('/'), array('default' => 'default'))->getContent());
    }

    public function testRenderWithAttributesOptions()
    {
        // with id
        $strategy = new HIncludeFragmentRenderer();
        $this->assertEquals('<hx:include src="/foo" id="bar">default</hx:include>', $strategy->render('/foo', Request::create('/'), array('default' => 'default', 'id' => 'bar'))->getContent());

        // with attributes
        $strategy = new HIncludeFragmentRenderer();
        $this->assertEquals('<hx:include src="/foo" p1="v1" p2="v2">default</hx:include>', $strategy->render('/foo', Request::create('/'), array('default' => 'default', 'attributes' => array('p1' => 'v1', 'p2' => 'v2')))->getContent());

        // with id & attributes
        $strategy = new HIncludeFragmentRenderer();
        $this->assertEquals('<hx:include src="/foo" p1="v1" p2="v2" id="bar">default</hx:include>', $strategy->render('/foo', Request::create('/'), array('default' => 'default', 'id' => 'bar', 'attributes' => array('p1' => 'v1', 'p2' => 'v2')))->getContent());
    }
}