import "./blocks/bubble-section.js";
import addAltDataImageBlock from "./lib/addAltDataImageBlock";

wp.domReady(() => {
  wp.blocks.registerBlockStyle("core/image", {
    name: "before", // 付与クラス: is-style-before
    label: "before",
  });
  wp.blocks.registerBlockStyle("core/image", {
    name: "after", // 付与クラス: is-style-after
    label: "after",
  });
  wp.blocks.registerBlockStyle("core/image", {
    name: "label", // 付与クラス: is-style-label
    label: "ラベル",
  });
});

const altBinder = addAltDataImageBlock();
altBinder.start();
