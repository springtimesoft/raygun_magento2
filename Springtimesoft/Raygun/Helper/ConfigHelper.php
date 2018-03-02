<?php

namespace Springtimesoft\Raygun\Helper;

/**
 * Class Data
 * @package Springtimesoft\Raygun\Helper
 */
class ConfigHelper extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * ScopeConfig
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;
    protected $customerSession;
    protected $client = null;
    protected $productMetadata;

    const CONFIG_ENABLED = 'raygun/general/enabled';
    const CONFIG_API_KEY = 'raygun/general/apikey';
    const CONFIG_IGNORE = 'raygun/advanced/ignore';
    const CONFIG_TAGS = 'raygun/advanced/tag';

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopInterface
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeInterface,
        \Magento\Framework\App\ProductMetadataInterface $productMetadata,
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->_scopeConfig = $scopeInterface;
        $this->productMetadata = $productMetadata;
        $this->customerSession = $customerSession;
    }

    /**
     * @param $config
     * @return mixed
     */
    public function getConfig($config)
    {
        return $this->_scopeConfig->getValue(
            $config,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Return Magento version.
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->productMetadata->getVersion();
    }

    /**
     * True if Raygun is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        $ignoreUrl = $this->getIgnoreUrl();

        if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] == $ignoreUrl) {
            return false;
        }

        return (bool)$this->getConfig(self::CONFIG_ENABLED);
    }

    /**
     * Return the Raygun API Key.
     *
     * @return string
     */
    public function getAPIKey()
    {
        return (string)$this->getConfig(self::CONFIG_API_KEY);
    }

    /**
     * Return the Raygun API Key.
     *
     * @return string
     */
    public function getIgnoreUrl()
    {
        return (string)$this->getConfig(self::CONFIG_IGNORE);
    }

    /**
     * Return tags to append to errors.
     *
     * @return array
     */
    public function getTags()
    {
        return explode(' ', (string)$this->getConfig(self::CONFIG_TAGS));
    }

    /**
     * Return the Raygun client.
     *
     */
    public function getClient()
    {
        if (!$this->getAPIKey() || !$this->isEnabled())
            return null;

        if (!$this->client) {
            require_once __DIR__ . '/../Raygun4php/RaygunClient.php';

            $this->client = new \Raygun4php\RaygunClient($this->getAPIKey());
            $this->client->SetVersion($this->getVersion());

            $customer = $this->customerSession->getCustomer();
            $customer_name = $customer->getName();
            $customer_email = $customer->getEmail();
            $customer_first_name = $customer->getFirstname();

            if ($customer !== null) {
                $this->client->SetUser(
                    $customer_name,            // Full name
                    $customer_email,           // Unique ID
                    $customer_first_name,       // First name
                    $customer_email,           // Email
                    ($customer_email == null), // Anonymous?
                    null                             // UUID
                );
            }
        }

        return $this->client;
    }

    /**
     * Exception error handler.
     * This takes care of actually submitting the message to Raygun (via the client API).
     *
     * @param  Exception $exception PHP Exception
     */
    public function exceptionHandler($exception)
    {
        try {
            if (!$this->getClient())
                return;

            // Send the exception!
            return $this->getClient()->SendException($exception, $this->getTags());
        } catch (Exception $e) {
            // Let Magento log this to file and we will get it later.
        }
    }

}