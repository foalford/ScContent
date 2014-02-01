<?php
/**
 * ScContent (https://github.com/dphn/ScContent)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013-2014 ScContent
 * @link      https://github.com/dphn/ScContent
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ScContent\Entity\Back;

use ScContent\Entity\AbstractList;

/**
 * @author Dolphin <work.dolphin@gmail.com>
 */
class ContentList extends AbstractList
{
    /**
     * @var array
     */
    protected $parent = [];

    /**
     * @var array
     */
    protected $back = [];

    /**
     * @var array
     */
    protected $counter = [
        'all'        => 0,
        'categories' => 0,
        'articles'   => 0,
        'files'      => 0,
    ];

    /**
     * @var integer
     */
    protected $totalPages = 1;

    /**
     * @var array
     */
    protected static $upper = [
        'site'  => ['id' => 0, 'title' => 'Site'],
        'trash' => ['id' => 0, 'title' => 'Trash'],
    ];

    /**
     * @param array $parent
     */
    public function __construct($parent)
    {
        $this->setParent($parent);
    }

    /**
     * @param object
     * @return void
     */
    public function addItem($item)
    {
        $this->items[] = $item;
    }

    /**
     * @param string $attribute optional
     * @return mixed
     */
    public function getParent($attribute = '')
    {
        if (! empty($attribute)) {
            return $this->parent[$attribute];
        }
        return $this->parent;
    }

    /**
     * @param array $back
     * @return void
     */
    public function setBack($back)
    {
        array_push(
            $back,
            $this->getParent('trash') ? self::$upper['trash'] : self::$upper['site']
        );
        $this->back = $back;
    }

    /**
     * @return array
     */
    public function getBack()
    {
        return $this->back;
    }

    /**
     * @param array $counter
     * @return void
     */
    public function setCounter($counter)
    {
        $this->counter = $counter;
    }

    /**
     * @param string $filter
     * @return integer | array
     */
    public function getCounter($filter = '')
    {
        if (! empty($filter)) {
            return (int) $this->counter[$filter];
        }
        return $this->counter;
    }

    /**
     * @return boolean
     */
    public function hasTop()
    {
        if ($this->parent['level'] > 0) {
            return true;
        }
        return false;
    }

    /**
     * @param string $attribute optional default <code>id</code>
     * @return mixed
     */
    public function getTop($attribute = 'id')
    {
        $top = $this->back[0];
        if (! empty($attribute)) {
            return $top[$attribute];
        }
        return $top;
    }

    /**
     * @param integer $total
     * @return void
     */
    public function setTotalPages($total)
    {
        $this->totalPages = (int) $total;
    }

    /**
     * @return integer
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * @param array $parent
     * @return void
     */
    protected function setParent($parent)
    {
        $this->parent = $parent;
    }
}
