# craft-shopify-resource plugin for Craft CMS 3.x

shopify-resource reference field via storefront api

store shopify storefront id in craft field with dropdown using shopify storefront api

use shopify products and collecitons in craft fields,  highly inspired by [nmaier95/craft-shopify-product-fetcher](https://github.com/nmaier95/craft-shopify-product-fetcher) but using the shopify storefront api, therefore ids compatible with [shopify buy sdk](https://github.com/Shopify/js-buy-sdk)
- send custom graphql queries to get resized images from shopify
- async clientside queries in cp do not slow down cp rendering with mutliple product fields

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
expects storefront-api credentials and locale settings to enable queries to the new shopify mutlilanguage api

```
return [
    'accessToken' => getenv('SHOPIFY_ACCESS_TOKEN'),
    'hostname' => getenv('SHOPIFY_HOSTNAME'),
    'hostnameOverwrite' => getenv('SHOPIFY_HOSTNAME_PUBLIC'),
    'locale' => 'en'
];
```

## Using craft-shopify-resource
you can use the plugin provided query (simular to shopify buy sdks product query)
or submit a custom query setup in twig
```
<p>
    <h2>Entry resource field with handle myResource</h2>
    shopify storefront id: {{entry.myResource}}

    <p>use product query provided by plugin</p>
    {%  set myResourceProduct  = craft.storefront.productById(entry.myResource) %}

    {% if myResourceProduct %}
        title : {{ myResourceProduct.title }}
    {% else %}
        myResource product not found
    {% endif %}
</p>

<p>
    <h2>Custom Query: list of products</h2>
    {% set query %}
        query searchProducts($term: String) {
            products(first: 250, query: $term) {
                edges {
                    node {
                        id
                        title
                    }
                }
            }
        }
    {% endset %}
    {% set productsResult = craft.storefront.query(query)['products']['edges'] %}
    {% if productsResult|length %}
        <h3>Product list</h3>
        {% for product in  productsResult|map(product => product.node) %}
            <p>{{ product.title }}</p>
        {% endfor %}
    {% endif %}
</p>
```


Brought to you by [devkai](https://toyflish.com)
