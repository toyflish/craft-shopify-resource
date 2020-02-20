<?php
/**
 * craft-shopify-resource plugin for Craft CMS 3.x
 *
 * shopify-resource reference field via storefront api
 *
 * @link      https://toyflish.com
 * @copyright Copyright (c) 2020 devkai
 */

namespace devkai\craftshopifyresource\services;

use devkai\craftshopifyresource\Craftshopifyresource;

use Craft;
use craft\base\Component;

/**
 * @author    devkai
 * @package   Craftshopifyresource
 * @since     1.0.0
 */
class Storefront extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';
        // Check our Plugin's settings for `someAttribute`
        if (Craftshopifyresource::$plugin->getSettings()->someAttribute) {
        }

        return $result;
    }
}
