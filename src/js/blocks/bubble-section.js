/**
 * Bubble Section Block
 * --------------------
 * <div class="wp-block-bubble bubble-section {type}">
 *   <div class="bubble-section__icon"></div>
 *   <div class="bubble-section__content">{InnerBlocks}</div>
 * </div>
 *
 * type:
 *  - ユーザー1 (default) : is-user-1
 *  - ユーザー2           : is-user-2
 *  - 会社               : is-user-ts
 */
import { registerBlockType } from "@wordpress/blocks";
import {
  InnerBlocks,
  InspectorControls,
  useBlockProps,
} from "@wordpress/block-editor";
import { PanelBody, SelectControl } from "@wordpress/components";

registerBlockType("custom/bubble-section", {
  apiVersion: 2,
  title: "吹き出し",
  icon: "format-chat",
  category: "custom",

  attributes: {
    type: { type: "string", default: "is-user-1" },
  },

  supports: { anchor: true },

  edit: ({ attributes, setAttributes }) => {
    const { type } = attributes;

    const blockProps = useBlockProps({
      className: `wp-block-bubble bubble-section ${type}`,
    });

    return (
      <>
        <InspectorControls>
          <PanelBody title="タイプ設定">
            <SelectControl
              label="タイプ"
              value={type}
              options={[
                { label: "ユーザー1", value: "is-user-1" },
                { label: "ユーザー2", value: "is-user-2" },
                { label: "会社", value: "is-user-ts" },
              ]}
              onChange={(val) => setAttributes({ type: val })}
            />
          </PanelBody>
        </InspectorControls>

        <div {...blockProps}>
          <div className="bubble-section__icon" />
          <div className="bubble-section__content">
            <InnerBlocks />
          </div>
        </div>
      </>
    );
  },

  save: ({ attributes }) => {
    const { type } = attributes;

    const blockProps = useBlockProps.save({
      className: `wp-block-bubble bubble-section ${type}`,
    });

    return (
      <div {...blockProps}>
        <div className="bubble-section__icon" />
        <div className="bubble-section__content">
          <InnerBlocks.Content />
        </div>
      </div>
    );
  },
});
