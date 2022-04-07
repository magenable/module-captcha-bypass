# Magenable Captcha Bypass

The extension disables Google reCAPTCHA for defined list of ip-addresses or a specific browser User-Agent. 
This can be useful for automated testing. 

## Installation

### Composer:

Run the following command in Magento 2 root folder

```
composer require magenable/module-captcha-bypass
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

- Go to **Stores** -> **Settings** -> **Configuration** in Magento admin
- Select **Magenable Extensions** and click on **Captcha Bypass**
- In group **General** set the field **Enabled** to **Yes** 
- In field **Whitelisted IP addresses** specify one or several ip-addresses separated by comma
- Or in field **Whitelisted User-Agent** specify User-Agent
- If one of the conditions (from previous two fields) is met the reCAPTCHA will not appear.
