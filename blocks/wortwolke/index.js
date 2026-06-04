(function (blocks, blockEditor, element, components, i18n, serverSideRender) {
  "use strict";

  var el = element.createElement;
  var Fragment = element.Fragment;
  var InspectorControls = blockEditor.InspectorControls;
  var useBlockProps = blockEditor.useBlockProps;
  var PanelBody = components.PanelBody;
  var TextControl = components.TextControl;
  var SelectControl = components.SelectControl;
  var RangeControl = components.RangeControl;
  var ServerSideRender = serverSideRender;
  var __ = i18n.__;

  var TAXONOMIES = [
    { label: __("Schlagwörter", "reinfeld"), value: "post_tag" },
    { label: __("Personen", "reinfeld"), value: "persons" },
    { label: __("Orte", "reinfeld"), value: "locations" },
    { label: __("Serien", "reinfeld"), value: "series" },
  ];

  blocks.registerBlockType("reinfeld/wortwolke", {
    edit: function (props) {
      var attributes = props.attributes;
      var setAttributes = props.setAttributes;
      var blockProps = useBlockProps();

      return el(
        Fragment,
        null,
        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: __("Einstellungen", "reinfeld"), initialOpen: true },
            el(TextControl, {
              label: __("Titel", "reinfeld"),
              value: attributes.title,
              onChange: function (value) {
                setAttributes({ title: value });
              },
            }),
            el(SelectControl, {
              label: __("Taxonomie", "reinfeld"),
              value: attributes.taxonomy,
              options: TAXONOMIES,
              onChange: function (value) {
                setAttributes({ taxonomy: value });
              },
            }),
            el(RangeControl, {
              label: __("Schwellenwert (Mindesthäufigkeit)", "reinfeld"),
              value: attributes.threshold,
              min: 1,
              max: 100,
              onChange: function (value) {
                setAttributes({ threshold: value });
              },
            }),
            el(RangeControl, {
              label: __("Minimale Schriftgröße (px)", "reinfeld"),
              value: attributes.minFontSize,
              min: 8,
              max: 100,
              onChange: function (value) {
                setAttributes({ minFontSize: value });
              },
            }),
            el(RangeControl, {
              label: __("Maximale Schriftgröße (px)", "reinfeld"),
              value: attributes.maxFontSize,
              min: 8,
              max: 100,
              onChange: function (value) {
                setAttributes({ maxFontSize: value });
              },
            }),
          ),
        ),
        el(
          "div",
          blockProps,
          el(ServerSideRender, {
            block: "reinfeld/wortwolke",
            attributes: attributes,
          }),
        ),
      );
    },

    save: function () {
      return null;
    },
  });
})(
  window.wp.blocks,
  window.wp.blockEditor,
  window.wp.element,
  window.wp.components,
  window.wp.i18n,
  window.wp.serverSideRender,
);
