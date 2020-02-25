/**
 * craft-shopify-resource plugin for Craft CMS
 *
 * Resource Field JS
 *
 * @author    devkai
 * @copyright Copyright (c) 2020 devkai
 * @link      https://toyflish.com
 * @package   Craftshopifyresource
 * @since     1.0.0CraftshopifyresourceResource
 */

import { GraphQLClient } from 'graphql-request'

const allProductsQuery = `query
  searchProducts($term: String) {
      products(first: 250, query: $term) {
        edges {
          node {
            id
            title
          }
        }
      }
}
 `
const allCollectionsQuery = `query
    searchCollections($term: String) {
      collections(first: 250, query: $term) {
        edges {
          node {
            id
            title
          }
        }
      }
    }
 `

;(function ( $, window, document, undefined ) {

    var pluginName = "CraftshopifyresourceResource",
        defaults = {
        };

    // Plugin constructor
    function Plugin( element, options ) {
        this.element = element;

        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;
        this.input = null;

        this.init();

    }

    Plugin.prototype = {
        buildSelect: function(selectOptions, selectedId) {
            const $select = $('<select>').appendTo(this.element.querySelector('.input .select'));
            $('<option value> -- none -- </option>').appendTo($select)
            $(selectOptions).each(function() {
                const option =  $("<option>").appendTo($select)
                option.attr('value',this.id).text(this.title)
                if(this.id === selectedId) option.attr('selected','selected')
            })
            $select.change((event ) => {
                const selected = event.target.selectedOptions[0].value
                console.log(selected)
                this.input.value = selected
            })
        },
        execQuery: function(query) {
            const { endpoint, accessToken, locale } = this.options;
            const graphQLClient = new GraphQLClient(endpoint, {
                headers: {
                    'X-Shopify-Storefront-Access-Token': accessToken,
                    'accept': 'application/json',
                    'accept-language': locale
                },
            })
            return graphQLClient.request(query)
        },
        init: function(id) {
            var _this = this;

            $(function () {
                const { namespace, resourceType } = _this.options;
                _this.input = document.getElementById(namespace)

                if(resourceType === 'Collection') {
                    _this.execQuery(allCollectionsQuery)
                        .then(data => data.collections.edges.map(e => e.node))
                        .then(options => _this.buildSelect(options, _this.input.value))
                        .catch(error => console.error(error))
                } else {
                    // resourceType = Product
                    _this.execQuery(allProductsQuery)
                        .then(data => data.products.edges.map(e => e.node))
                        .then(options => _this.buildSelect(options, _this.input.value))
                        .catch(error => console.error(error))
                }
            });
        }
    };

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations
    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName,
                    new Plugin( this, options ));
            }
        });
    };

})( jQuery, window, document );
