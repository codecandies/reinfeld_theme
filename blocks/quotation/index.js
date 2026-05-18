(function (blocks, blockEditor, element, i18n) {
  "use strict";

  var el = element.createElement;
  var RichText = blockEditor.RichText;
  var useBlockProps = blockEditor.useBlockProps;
  var __ = i18n.__;

  blocks.registerBlockType("reinfeld/quotation", {
    edit: function (props) {
      var attributes = props.attributes;
      var setAttributes = props.setAttributes;
      var blockProps = useBlockProps({ className: "rf-quotation" });

      return el(
        "figure",
        blockProps,
        el(RichText, {
          tagName: "blockquote",
          multiline: "p",
          className: "rf-quotation__quote",
          value: attributes.quote,
          onChange: function (value) {
            setAttributes({ quote: value });
          },
          placeholder: __("Zitat …", "reinfeld"),
        }),
        el(RichText, {
          tagName: "figcaption",
          className: "rf-quotation__caption",
          allowedFormats: ["core/bold", "core/italic", "core/link"],
          value: attributes.caption,
          onChange: function (value) {
            setAttributes({ caption: value });
          },
          placeholder: __("Quelle (optional) …", "reinfeld"),
        }),
      );
    },

    save: function () {
      return null;
    },
  });
})(window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.i18n);
