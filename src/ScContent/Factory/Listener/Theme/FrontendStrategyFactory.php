<?php
/**
 * ScContent (https://github.com/dphn/ScContent)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013-2014 ScContent
 * @link      https://github.com/dphn/ScContent
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ScContent\Factory\Listener\Theme;

use ScContent\Listener\Theme\FrontendStrategy,
    //
    Zend\ServiceManager\ServiceLocatorInterface,
    Zend\ServiceManager\FactoryInterface;

/**
 * @author Dolphin <work.dolphin@gmail.com>
 */
class FrontendStrategyFactory implements FactoryInterface
{
    /**
     * @param Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return ScContent\Listener\Theme\FrontendStrategy
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $controllerManager = $serviceLocator->get('ControllerLoader');
        $moduleOptions = $serviceLocator->get('ScOptions.ModuleOptions');
        $layoutMapper = $serviceLocator->get('ScMapper.Theme.FrontendLayoutMapper');
        $contentService = $serviceLocator->get('ScService.Front.ContentService');

        $strategy = new FrontendStrategy();

        $strategy->setContentService($contentService);
        $strategy->setControllerManager($controllerManager);
        $strategy->setModuleOptions($moduleOptions);
        $strategy->setLayoutMapper($layoutMapper);

        return $strategy;
    }
}
