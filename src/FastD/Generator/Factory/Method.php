<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/2/19
 * Time: 下午6:18
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Generator\Factory;

/**
 * Class Method
 *
 * @package FastD\Generator\Factory
 */
class Method extends Generate
{
    const METHOD_ACCESS_PUBLIC      = 'public';
    const METHOD_ACCESS_PROTECTED   = 'protected';
    const METHOD_ACCESS_PRIVATE     = 'private';

    const METHOD_NULL       = 'default';
    const METHOD_ABSTRACT   = 'abstract';
    const METHOD_INTERFACE  = 'interface';
    const METHOD_STATIC     = 'static';

    /**
     * @var array
     */
    protected $params = [];

    protected $access;

    public function __construct($name, $access = self::METHOD_ACCESS_PUBLIC, $type = self::METHOD_NULL, $desc = null)
    {
        $this->access = $access;

        parent::__construct($name, $type, $desc);
    }

    public function setParams(array $params)
    {
        $this->params = $params;

        return $this;
    }

    public function getAccess()
    {
        return $this->access;
    }

    public function generate()
    {
        return $this->skeleton();
    }

    public function skeleton()
    {
        $params = [];
        foreach ($this->params as $param) {
            if ($param instanceof Object) {
                $params[] = ltrim(implode('\\', [$param->getnamespace(), '$' . $param->getName()]), '\\');
            } else {
                $params[] = '$' . $param;
            }
        }
        $params = implode(', ', $params);

        switch ($this->getType()) {
            case self::METHOD_INTERFACE:
                return <<<M
    {$this->getAccess()} function {$this->name}({$params});
M;
                break;
            case self::METHOD_ABSTRACT:
                return <<<M
    {$this->getType()} {$this->getAccess()} function {$this->name}({$params});
M;
                break;
            case self::METHOD_STATIC:
                return <<<M
    {$this->getAccess()} {$this->getType()} function {$this->name}({$params})
    {
        // TODO...
    }
M;
                break;
            case self::METHOD_NULL:
            default:
                return <<<M
    {$this->getAccess()} function {$this->name}({$params})
    {
        // TODO...
    }
M;

        }
    }
}