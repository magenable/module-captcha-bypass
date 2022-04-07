# Magenable Captcha Bypass

The extension allows you to disable recaptcha on the site for certain ip-addresses or a specific browser User-Agent, this can be useful in time during automatic testing of the site.

## Installation

### Composer:

Run the following command in Magento 2 root folder

```
composer require magenable/module-captcha-bypass
bin/magento module:enable Magenable_CaptchaBypass
bin/magento setup:upgrade
```
## Upgrade

### Composer:

Run the following command in Magento 2 root folder

```
composer update magenable/module-captcha-bypass
bin/magento setup:upgrade
```

## Extension Settings

- In the menu of admin panel select **Stores** -> **Settings** -> **Configuration**
- Select **Magenable Extensions** and click on **Captcha Bypass**
- In group **General** in field **Enabled** select **Yes** 
- In field **Whitelisted IP addresses** specify one or few ip-addresses separated by comma
- Or in field **Whitelisted User-Agent** specify User-Agent
- If one of this condition (from previous two fields) will meet the recaptcha will be disabled.
