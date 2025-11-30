/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./js/blocks/bubble-section.js":
/*!*************************************!*\
  !*** ./js/blocks/bubble-section.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
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



(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockType)("custom/bubble-section", {
  apiVersion: 2,
  title: "吹き出し",
  icon: "format-chat",
  category: "custom",
  attributes: {
    type: {
      type: "string",
      default: "is-user-1"
    }
  },
  supports: {
    anchor: true
  },
  edit: function edit(_ref) {
    var attributes = _ref.attributes,
      setAttributes = _ref.setAttributes;
    var type = attributes.type;
    var blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps)({
      className: "wp-block-bubble bubble-section ".concat(type)
    });
    return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InspectorControls, null, /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelBody, {
      title: "\u30BF\u30A4\u30D7\u8A2D\u5B9A"
    }, /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.SelectControl, {
      label: "\u30BF\u30A4\u30D7",
      value: type,
      options: [{
        label: "ユーザー1",
        value: "is-user-1"
      }, {
        label: "ユーザー2",
        value: "is-user-2"
      }, {
        label: "会社",
        value: "is-user-ts"
      }],
      onChange: function onChange(val) {
        return setAttributes({
          type: val
        });
      }
    }))), /*#__PURE__*/React.createElement("div", blockProps, /*#__PURE__*/React.createElement("div", {
      className: "bubble-section__icon"
    }), /*#__PURE__*/React.createElement("div", {
      className: "bubble-section__content"
    }, /*#__PURE__*/React.createElement(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks, null))));
  },
  save: function save(_ref2) {
    var attributes = _ref2.attributes;
    var type = attributes.type;
    var blockProps = _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps.save({
      className: "wp-block-bubble bubble-section ".concat(type)
    });
    return /*#__PURE__*/React.createElement("div", blockProps, /*#__PURE__*/React.createElement("div", {
      className: "bubble-section__icon"
    }), /*#__PURE__*/React.createElement("div", {
      className: "bubble-section__content"
    }, /*#__PURE__*/React.createElement(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks.Content, null)));
  }
});

/***/ }),

/***/ "./js/lib/addAltDataImageBlock.js":
/*!****************************************!*\
  !*** ./js/lib/addAltDataImageBlock.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ addAltDataImageBlock)
/* harmony export */ });
function _createForOfIteratorHelper(r, e) { var t = "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (!t) { if (Array.isArray(r) || (t = _unsupportedIterableToArray(r)) || e && r && "number" == typeof r.length) { t && (r = t); var _n = 0, F = function F() {}; return { s: F, n: function n() { return _n >= r.length ? { done: !0 } : { done: !1, value: r[_n++] }; }, e: function e(r) { throw r; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var o, a = !0, u = !1; return { s: function s() { t = t.call(r); }, n: function n() { var r = t.next(); return a = r.done, r; }, e: function e(r) { u = !0, o = r; }, f: function f() { try { a || null == t.return || t.return(); } finally { if (u) throw o; } } }; }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
/*
Usage: addAltDataImageBlock.js
---
import addAltDataImageBlock from './lib/addAltDataImageBlock';

const altBinder = addAltDataImageBlock();
altBinder.start();
*/

var addAltDataImageBlock = function addAltDataImageBlock() {
  var SELECTOR = "figure.is-style-label";
  var boundImgs = new WeakSet();
  var applyAlt = function applyAlt(figure) {
    if (!figure || !figure.matches(SELECTOR)) return;
    var img = figure.querySelector("img");
    if (!img) return;
    figure.dataset.alt = typeof img.alt === "string" ? img.alt : "";
    if (boundImgs.has(img)) return;
    img.addEventListener("load", function () {
      figure.dataset.alt = img.alt || "";
    });
    var imgObserver = new MutationObserver(function (mutations) {
      var _iterator = _createForOfIteratorHelper(mutations),
        _step;
      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var m = _step.value;
          if (m.type === "attributes" && m.attributeName === "alt") {
            figure.dataset.alt = img.alt || "";
          }
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }
    });
    imgObserver.observe(img, {
      attributes: true,
      attributeFilter: ["alt"]
    });
    img.__altDataObserver = imgObserver;
    boundImgs.add(img);
  };
  var processFigure = function processFigure(figure) {
    if (!(figure instanceof Element)) return;
    if (!figure.matches(SELECTOR)) return;
    applyAlt(figure);
  };
  var init = function init() {
    document.querySelectorAll(SELECTOR).forEach(processFigure);
  };
  var docObserver = new MutationObserver(function (mutations) {
    var _iterator2 = _createForOfIteratorHelper(mutations),
      _step2;
    try {
      for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
        var m = _step2.value;
        if (m.type === "childList") {
          m.addedNodes.forEach(function (node) {
            var _node$matches, _node$querySelectorAl, _node$matches2;
            if (!(node instanceof Element)) return;
            if ((_node$matches = node.matches) !== null && _node$matches !== void 0 && _node$matches.call(node, SELECTOR)) processFigure(node);
            (_node$querySelectorAl = node.querySelectorAll) === null || _node$querySelectorAl === void 0 || _node$querySelectorAl.call(node, SELECTOR).forEach(processFigure);
            if ((_node$matches2 = node.matches) !== null && _node$matches2 !== void 0 && _node$matches2.call(node, "img")) {
              var _node$closest;
              var fig = (_node$closest = node.closest) === null || _node$closest === void 0 ? void 0 : _node$closest.call(node, SELECTOR);
              if (fig) applyAlt(fig);
            } else {
              var _node$querySelectorAl2;
              (_node$querySelectorAl2 = node.querySelectorAll) === null || _node$querySelectorAl2 === void 0 || _node$querySelectorAl2.call(node, "img").forEach(function (img) {
                var _img$closest;
                var fig = (_img$closest = img.closest) === null || _img$closest === void 0 ? void 0 : _img$closest.call(img, SELECTOR);
                if (fig) applyAlt(fig);
              });
            }
          });
        }
        if (m.type === "attributes" && m.attributeName === "class") {
          var _el$matches;
          var el = m.target;
          if (el instanceof Element && (_el$matches = el.matches) !== null && _el$matches !== void 0 && _el$matches.call(el, SELECTOR)) {
            processFigure(el);
          }
        }
      }
    } catch (err) {
      _iterator2.e(err);
    } finally {
      _iterator2.f();
    }
  });
  var start = function start() {
    init();
    docObserver.observe(document.documentElement, {
      childList: true,
      subtree: true,
      attributes: true,
      attributeFilter: ["class"]
    });
  };
  var stop = function stop() {
    docObserver.disconnect();
    document.querySelectorAll("".concat(SELECTOR, " img")).forEach(function (img) {
      if (img.__altDataObserver) {
        img.__altDataObserver.disconnect();
        delete img.__altDataObserver;
      }
    });
  };
  return {
    start: start,
    stop: stop
  };
};


/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ ((module) => {

module.exports = wp.blockEditor;

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ ((module) => {

module.exports = wp.blocks;

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = wp.components;

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./js/blocks.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _blocks_bubble_section_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./blocks/bubble-section.js */ "./js/blocks/bubble-section.js");
/* harmony import */ var _lib_addAltDataImageBlock__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./lib/addAltDataImageBlock */ "./js/lib/addAltDataImageBlock.js");


wp.domReady(function () {
  wp.blocks.registerBlockStyle("core/image", {
    name: "before",
    // 付与クラス: is-style-before
    label: "before"
  });
  wp.blocks.registerBlockStyle("core/image", {
    name: "after",
    // 付与クラス: is-style-after
    label: "after"
  });
  wp.blocks.registerBlockStyle("core/image", {
    name: "label",
    // 付与クラス: is-style-label
    label: "ラベル"
  });
});
var altBinder = (0,_lib_addAltDataImageBlock__WEBPACK_IMPORTED_MODULE_1__["default"])();
altBinder.start();
})();

/******/ })()
;
//# sourceMappingURL=blocks.js.map