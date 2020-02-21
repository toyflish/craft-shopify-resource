<?php
/**
 * craft-shopify-resource plugin for Craft CMS 3.x
 *
 * shopify-resource reference field via storefront api
 *
 * @link      https://toyflish.com
 * @copyright Copyright (c) 2020 devkai
 */

namespace devkai\craftshopifyresource\models;

use devkai\craftshopifyresource\Craftshopifyresource;

use Craft;
use craft\base\Model;

/**
 * @author    devkai
 * @package   Craftshopifyresource
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */

    public $accessToken;
    public $hostname;
    public $hostnameOverwrite;
    public $locale;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['accessToken','hostname','hostnameOverwrite','locale'], 'required']
        ];
    }
}
