<?php
/**
 * ScContent (https://github.com/dphn/ScContent)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013-2014 ScContent
 * @link      https://github.com/dphn/ScContent
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ScContent\Factory\Service;

use ScContent\Service\Localization,
    //
    Zend\ServiceManager\ServiceLocatorInterface,
    Zend\ServiceManager\FactoryInterface;

/**
 * @author Dolphin <work.dolphin@gmail.com>
 */
class LocalizationFactory implements FactoryInterface
{
    /**
     * @param  \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return \ScContent\Service\Localization
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $translator = $serviceLocator->get('translator');
        $datetime   = $serviceLocator->get('ScService.DateTime');
        $plugins    = $serviceLocator->get('ViewHelperManager');
        $dateformat = $plugins->get('dateformat');
        $l10n = new Localization($translator, $dateformat, $datetime);
        return $l10n;
    }
}
