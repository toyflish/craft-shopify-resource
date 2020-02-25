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
use doublesecretagency\smartmap\web\assets\DebugAssets;
use \GuzzleHttp\Client;

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
    public function getProductById($id)
    {
        return $this->query($this->productByIdQuery, ['id' => $id])['node'];
    }

    public function query( $query, $variables = [])
    {

        $settings = Craftshopifyresource::$plugin->getSettings();

        $body = ['query' => $query];
        if(!empty($variables)) $body['variables'] = $variables;

        try {
            $client = new Client([
                'headers' => [
                    'X-Shopify-Storefront-Access-Token' => $settings['accessToken'],
                    'accept' => 'application/json',
                    'accept-language' => $settings['locale']
                ]
            ]);
            $response = $client->request('POST', $settings->endpoint(), ['json' => $body]);
            if ($response->getStatusCode() !== 200) {
                Craft::error("storefront query responds with : ".$response->getStatusCode());
                return false;
            }
        } catch(\Exception $e) {
            Craft::error($e->getMessage());
            return false;
        }
        return json_decode($response->getBody()->getContents(), true)['data'];
    }

    private $productByIdQuery = <<<'GRAPHQL'
query productById($id: ID!) {
  node(id: $id) {
    ...ProductFragment
  }
}

fragment ProductFragment on Product {
  id
  availableForSale
  createdAt
  updatedAt
  descriptionHtml
  description
  handle
  productType
  title
  vendor
  publishedAt
  onlineStoreUrl
  options {
    name
    values
  }
  images(first: 250) {
    pageInfo {
      hasNextPage
      hasPreviousPage
    }
    edges {
      cursor
      node {
        id
        src
        altText
      }
    }
  }
  variants(first: 250) {
    pageInfo {
      hasNextPage
      hasPreviousPage
    }
    edges {
      cursor
      node {
        ...VariantFragment
      }
    }
  }
}

fragment VariantFragment on ProductVariant {
  id
  title
  price
  priceV2 {
    amount
    currencyCode
  }
  presentmentPrices(first: 20) {
    pageInfo {
      hasNextPage
      hasPreviousPage
    }
    edges {
      node {
        price {
          amount
          currencyCode
        }
        compareAtPrice {
          amount
          currencyCode
        }
      }
    }
  }
  weight
  available: availableForSale
  sku
  compareAtPrice
  compareAtPriceV2 {
    amount
    currencyCode
  }
  image {
    id
    src: originalSrc
    altText
  }
  selectedOptions {
    name
    value
  }
  unitPrice {
    amount
    currencyCode
  }
  unitPriceMeasurement {
    measuredType
    quantityUnit
    quantityValue
    referenceUnit
    referenceValue
  }
}
GRAPHQL;
}

