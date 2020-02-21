<?php
/**
 * craft-shopify-resource plugin for Craft CMS 3.x
 *
 * shopify-resource reference field via storefront api
 *
 * @link      https://toyflish.com
 * @copyright Copyright (c) 2020 devkai
 */

/**
 * craft-shopify-resource config.php
 *
 * This file exists only as a template for the craft-shopify-resource settings.
 * It does nothing on its own.
 *
 * Don't edit this file, instead copy it to 'craft/config' as 'craft-shopify-resource.php'
 * and make your changes there to override default settings.
 *
 * Once copied to 'craft/config', this file will be multi-environment aware as
 * well, so you can have different settings groups for each environment, just as
 * you do for 'general.php'
 */

return [
    'accessToken' => getenv('SHOPIFY_ACCESS_TOKEN'),
    'hostname' => getenv('SHOPIFY_HOSTNAME'),
    'hostnameOverwrite' => getenv('SHOPIFY_HOSTNAME_PUBLIC'),
    'locale' => 'en'
];
