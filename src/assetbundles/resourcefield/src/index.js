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

const allProductsQuery = `query {
  products(first:250){
    edges {
      node {
        id
        title
      }
    }
  }
}`

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
            const $select = $('<select>').appendTo(this.element.querySelector('.input'));
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

        init: function(id) {
            var _this = this;

            $(function () {
                const $input = $(_this.element).find("input[name=\"fields[myResource]\"]")
                _this.input = $input.get(0)
                const value = $input.val()
                const { hostname, accessToken, locale } = _this.options;
                const endpoint = `https://${hostname}/api/2020-01/graphql`

                const graphQLClient = new GraphQLClient(endpoint, {
                    headers: {
                        'X-Shopify-Storefront-Access-Token': accessToken,
                        'accept': 'application/json',
                        'accept-language': locale
                    },
                })
                graphQLClient.request(allProductsQuery)
                    .then(data => {
                        window.data = data
                        const options = data.products.edges.map(e => e.node)
                        _this.buildSelect(options, value)
                        console.log({_this})
                        window._this = _this
                    })
                    .catch(error => console.error(error))
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
