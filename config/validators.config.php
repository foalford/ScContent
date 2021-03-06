<?php
/**
 * ScContent (https://github.com/dphn/ScContent)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013-2014 ScContent
 * @link      https://github.com/dphn/ScContent
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return [
    'invokables' => [
        'ScValidator.Installation.PhpIni'
            => 'ScContent\Validator\Installation\PhpIni',

        'ScValidator.Installation.PhpExtension'
            => 'ScContent\Validator\Installation\PhpExtension',

        'ScValidator.ContentList.SearchDateRange'
            => 'ScContent\Validator\ContentList\SearchDateRange',

        'ScValidator.Db.Connection'
            => 'ScContent\Validator\Db\Connection',

        'ScValidator.File.Name'
            => 'ScContent\Validator\File\FileName',

        'ScValidator.Mapper.Nesting'
            => 'ScContent\Validator\Mapper\NestingValidator',
    ],
    'factories' => [
        'ScValidator.Installation.Autoload'
            => 'ScContent\Factory\Validator\Installation\AutoloadFactory',

        'ScValidator.Installation.Config'
            => 'ScContent\Factory\Validator\Installation\ConfigFactory',

        'ScValidator.Installation.Uploads'
            => 'ScContent\Factory\Validator\Installation\UploadsFactory',

        'ScValidator.Installation.Migration'
            => 'ScContent\Factory\Validator\Installation\MigrationFactory',

        'ScValidator.Installation.Assets'
            => 'ScContent\Factory\Validator\Installation\AssetsFactory',

        'ScValidator.Installation.Layout'
            => 'ScContent\Factory\Validator\Installation\LayoutFactory',

        'ScValidator.Installation.Roles'
            => 'ScContent\Factory\Validator\Installation\RolesFactory',

        'ScValidator.Installation.Account'
            => 'ScContent\Factory\Validator\Installation\AccountFactory',

        'ScValidator.File.Type'
            => 'ScContent\Factory\Validator\FileTypeFactory',
    ],
];
