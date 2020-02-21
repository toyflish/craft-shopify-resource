# craft-shopify-resource plugin for Craft CMS 3.x

shopify-resource reference field via storefront api

store shopify storefront id in craft field with dropdown select using shopify storefront api


## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require toyflish/craft-shopify-resource

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for craft-shopify-resource.

## craft-shopify-resource Overview

adds a shopify resource select field to your control panel

## Configuring craft-shopify-resource

```
return [
    'accessToken' => getenv('SHOPIFY_ACCESS_TOKEN'),
    'hostname' => getenv('SHOPIFY_HOSTNAME'),
    'hostnameOverwrite' => getenv('SHOPIFY_HOSTNAME_PUBLIC'),
    'locale' => 'en'
];
```

## Using craft-shopify-resource



Brought to you by [devkai](https://toyflish.com)
