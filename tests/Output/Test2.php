<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/2/22
 * Time: 下午12:33
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace Test;

use FastD\Generator\Generator;

class Test2 extends Test implements TestInterface
{
    const TESET = 'abc';

    protected $name = null;

    protected $default = 'jan';

    protected static $age = 18;

    public function test(Generator $generator, $name = 'test', $test = self::TESET, $four = 11)
    {}
}