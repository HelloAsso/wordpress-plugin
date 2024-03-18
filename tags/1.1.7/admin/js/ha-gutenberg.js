// Import registerBlockType() from block building libary
const { registerBlockType } = wp.blocks;
// Import the element creator function (React abstraction layer)
const el = wp.element.createElement;

const smileIcon = wp.element.createElement('svg',
  {
    width: 20,
    height: 20,
    viewBox: '0 0 76 77'
  },
  wp.element.createElement('path',
    {
      d: "M6.53448 18.0371C16.1797 2.87279 35.3841 -3.71726 52.4911 3.32119C55.2155 4.54673 57.5385 5.8922 59.5077 7.32418C64.8194 11.251 67.4172 15.8148 68.3953 20.3477C69.4044 25.025 68.7234 29.8285 67.2743 34.0975C66.816 33.3055 66.2493 32.4863 65.5985 31.6569C63.2852 28.7084 59.713 25.3817 55.3928 22.3249C46.815 16.2557 34.9192 10.9965 23.5701 12.1801C18.5344 12.0966 11.8746 13.6381 6.53448 18.0371Z"
    }
  ),
  wp.element.createElement('path',
    {
      d: "M29.7061 65.4573C28.885 65.5437 28.0957 65.5896 27.3498 65.5902C30.5533 68.7842 34.3118 71.7877 38.6844 73.4322C39.5414 73.7545 40.4265 74.0262 41.3407 74.2362C47.0457 75.3623 53.7978 74.2639 61.337 68.708C75.7858 57.3842 79.8545 37.4806 71.9679 21.4769C72.951 27.9653 71.1466 34.3735 68.3512 39.3728C68.3028 39.4734 68.2542 39.5735 68.2053 39.673L68.2036 39.6764C62.964 50.2778 52.4104 57.6822 42.8505 61.7657C38.0556 63.8139 33.4219 65.0661 29.7061 65.4573Z"
    }
  ),
  wp.element.createElement('path',
    {
      d: "M21.4204 63.6132L21.5905 63.8073C24.7608 68.3154 30.1035 73.6333 37.1037 76.1612C37.7023 76.3774 38.3117 76.5726 38.9315 76.745C20.0686 77.0756 3.52335 63.1207 0.82426 43.7424C0.180518 32.6677 4.04029 25.8036 8.88748 21.5733C12.2239 18.6615 16.0907 16.946 19.4281 16.017C19.0012 16.8597 18.5941 17.8192 18.2117 18.8632C16.8781 22.5037 15.7465 27.444 15.1635 32.7912C14.5802 38.1409 14.5386 43.9669 15.428 49.3719C16.3147 54.7609 18.1479 59.8562 21.4185 63.611L21.4204 63.6132Z"
    }
  )
);


wp.blocks.registerBlockType('brad/border-box', {
  title: 'HelloAsso',
  icon: smileIcon,
  category: 'widgets',
  attributes: {
    shortcode: { type: 'string' }
  },

  /* This configures how the content and color fields will work, and sets up the necessary elements */

  edit: function (props) {
    function openPopup(event) {
      jQuery(event.target).parent().find('.ha-input-shortcode').val('');
      jQuery('#ha-popup-open').trigger('click');

    }
    function updateShortcode(event) {
      var shortcode = jQuery(event.target).parent().find('.ha-input-shortcode').val();
      props.setAttributes({ shortcode })
    }
    return React.createElement(
      "div",
      { class: "ha-gutenberg" },
      React.createElement(
        "h3",
        null,
        "HelloAsso"
      ),
      React.createElement("input", { type: "text", class: "ha-input-shortcode", onFocus: updateShortcode, onChange: updateShortcode, placeholder: 'Shortcode HelloAsso', value: props.attributes.shortcode }),
      React.createElement("a", { class: "ha-btn", href: "#ha-popup", onClick: openPopup }, 'Afficher mes campagnes')
    );
  },
  save: function (props) {
    return wp.element.createElement(
      "div",
      {},
      props.attributes.shortcode
    );
  }
})