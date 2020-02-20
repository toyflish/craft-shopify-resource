<?php
/**
 * craft-shopify-resource plugin for Craft CMS 3.x
 *
 * shopify-resource reference field via storefront api
 *
 * @link      https://toyflish.com
 * @copyright Copyright (c) 2020 devkai
 */

namespace devkai\craftshopifyresource\assetbundles\Craftshopifyresource;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    devkai
 * @package   Craftshopifyresource
 * @since     1.0.0
 */
class CraftshopifyresourceAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@devkai/craftshopifyresource/assetbundles/craftshopifyresource/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/Craftshopifyresource.js',
        ];

        $this->css = [
            'css/Craftshopifyresource.css',
        ];

        parent::init();
    }
}
