<?php
/**
 * ScContent (https://github.com/dphn/ScContent)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013-2014 ScContent
 * @link      https://github.com/dphn/ScContent
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ScContent\Factory\Mapper\Back;

use ScContent\Mapper\Back\WidgetVisibilityChangeMapper,
    //
    Zend\ServiceManager\ServiceLocatorInterface,
    Zend\ServiceManager\FactoryInterface;

/**
 * @author Dolphin <work.dolphin@gmail.com>
 */
class WidgetVisibilityChangeMapperFactory implements FactoryInterface
{
    /**
     * @param  \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return \ScContent\Mapper\Back\WidgetVisibilityChangeMapper
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('ScDb.Adapter');
        $mapper = new WidgetVisibilityChangeMapper($adapter);
        return $mapper;
    }
}
