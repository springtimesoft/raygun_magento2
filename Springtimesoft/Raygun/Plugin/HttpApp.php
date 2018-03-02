<?php
/**
 * Raygun error tracking for Magento 2
 *
 * @package     Springtimesoft_Raygun
 * @author      Springtimesoft (https://www.springtimesoft.co.nz/)
 * @copyright   Copyright 2018 Springtimesoft (https://www.springtimesoft.co.nz/)
 * @license     Open Source License (OSL v3)
 */

namespace Springtimesoft\Raygun\Plugin;
use \Springtimesoft\Raygun\Helper\ConfigHelper;

/**
 * Class HttpApp - Plugin for \Magento\Framework\App\Http
 */
class HttpApp
{
    protected $helper;

    public function __construct(ConfigHelper $helper)
    {
        $this->helper = $helper;
    }

    public function beforeCatchException(
        \Magento\Framework\App\Http $subject,
        \Magento\Framework\App\Bootstrap $bootstrap,
        \Exception $exception
    )
    {
        if ($bootstrap->isDeveloperMode()) {

            $this->helper->exceptionHandler($exception);
        }

        return [$bootstrap, $exception];
    }
}