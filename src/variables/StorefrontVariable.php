<?php
/**
 * craft-shopify-resource plugin for Craft CMS 3.x
 *
 * shopify-resource reference field via storefront api
 *
 * @link      https://toyflish.com
 * @copyright Copyright (c) 2020 devkai
 */

namespace devkai\craftshopifyresource\variables;

use devkai\craftshopifyresource\Craftshopifyresource;

use Craft;

/**
 * @author    devkai
 * @package   Craftshopifyresource
 * @since     1.0.0
 */
class StorefrontVariable
{
    // Public Methods
    // =========================================================================

    public function getProductById($id)
    {
        return Craftshopifyresource::getInstance()->storefront->getProductById($id);
    }
    public function query($query, $variables = [])
    {
        return Craftshopifyresource::getInstance()->storefront->query($query, $variables = []);
    }
}
