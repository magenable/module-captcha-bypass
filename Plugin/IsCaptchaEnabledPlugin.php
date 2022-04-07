<?php

declare(strict_types=1);

namespace Magenable\CaptchaBypass\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\ReCaptchaUi\Model\IsCaptchaEnabled;
use Magento\Framework\HTTP\Header;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Store\Model\ScopeInterface;

class IsCaptchaEnabledPlugin
{
    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @var Header
     */
    private Header $httpHeader;

    /**
     * @var RemoteAddress
     */
    private RemoteAddress $remoteAddress;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param Header $httpHeader
     * @param RemoteAddress $remoteAddress
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Header $httpHeader,
        RemoteAddress $remoteAddress
    ) {

        $this->httpHeader = $httpHeader;
        $this->remoteAddress = $remoteAddress;
        $this->scopeConfig = $scopeConfig;
    }

    public function afterIsCaptchaEnabledFor(
        IsCaptchaEnabled $subject,
        bool $result
    ) {
        if (!$this->scopeConfig->getValue('magenable_captcha_bypass/general/enabled', ScopeInterface::SCOPE_STORE)) {
            return $result;
        }

        $ipWhitelisted = $this->scopeConfig->getValue(
            'magenable_captcha_bypass/general/ip_whitelist',
            ScopeInterface::SCOPE_STORE
        );
        $userAgentWhitelisted = $this->scopeConfig->getValue(
            'magenable_captcha_bypass/general/user_agent_whitelist',
            ScopeInterface::SCOPE_STORE
        );
        if (!$ipWhitelisted && !$userAgentWhitelisted) {
            return $result;
        }

        $checkIp = false;
        if ($ipWhitelisted) {
            $ipWhitelisted = explode(',', $ipWhitelisted);
            $remoteIp = $this->remoteAddress->getRemoteAddress();
            foreach ($ipWhitelisted as $ipWhite) {
                if ($remoteIp === trim($ipWhite)) {
                    $checkIp = true;
                    break;
                }
            }
        }

        $checkUserAgent = false;
        if ($userAgentWhitelisted) {
            $userAgent = $this->httpHeader->getHttpUserAgent();
            if ($userAgent === $userAgentWhitelisted) {
                $checkUserAgent = true;
            }
        }

        if ($checkIp || $checkUserAgent) {
            return false;
        }

        return $result;
    }
}
