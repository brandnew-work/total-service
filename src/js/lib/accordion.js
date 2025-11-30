/*
Usage: Accordion.js
---
import Accordion from './lib/accordion';

const acc = new Accordion('.js-acc', {
  speed: 400,           // アニメーション速度(ms)
  target: 'next',       // 'next' | 'previous'
  event: 'click',       // 'click' など
  breakpoint: 0,        // 0 = 常に有効
  breakpointType: 'max',// 'max' or 'min'（breakpoint 有効時のみ）
  disableLink: false    // トグル要素が <a> のときリンク無効化
  display: 'block'      // 開いたときのdisplay
});
*/

const removeStyles = (el, styles) => {
  styles.forEach(style => el.style.removeProperty(style));
}

class Accordion {
  constructor(selector, options = {}) {
    this.selector = selector;
    this.options = {
      speed: 500,
      target: 'next',
      event: 'click',
      breakpoint: 0,             // px
      breakpointType: 'max',     // 'max', 'min'
      disableLink: false,        // 直下の<a>タグがあればリンク無効化
      display: 'block',
      ...options
    };
    this.enabled = false;
    this.handleResize = this.update.bind(this);
    window.addEventListener('resize', this.handleResize);
    this.init();
  }

  slideUp = (el, d = this.options.speed) => {
    el.style.height = `${el.offsetHeight}px`; el.offsetHeight;
    Object.assign(el.style, {
      transition: `height ${d}ms ease, margin ${d}ms ease, padding ${d}ms ease`,
      overflow: "hidden", height: 0, paddingTop: 0, paddingBottom: 0, marginTop: 0, marginBottom: 0
    });
    setTimeout(() => {
      el.style.display = "none";
      removeStyles(el, [
        "height", "padding-top", "padding-bottom", "margin-top", "margin-bottom", "overflow",
        "transition-duration", "transition-property", "transition-timing-function", "transition"
      ]);
    }, d);
  };

  slideDown = (el, d = this.options.speed) => {
    el.style.removeProperty("display");
    if (getComputedStyle(el).display === "none") el.style.display = this.options.display;
    const h = el.offsetHeight;
    Object.assign(el.style, {
      overflow: "hidden", height: 0, paddingTop: 0, paddingBottom: 0, marginTop: 0, marginBottom: 0
    });
    el.offsetHeight;
    Object.assign(el.style, {
      transition: `height ${d}ms ease, margin ${d}ms ease, padding ${d}ms ease`,
      height: `${h}px`
    });
    ["paddingTop", "paddingBottom", "marginTop", "marginBottom"].forEach(p => el.style[p] = "");
    setTimeout(() => {
      removeStyles(el, [
        "height", "overflow", "transition-duration", "transition-property", "transition-timing-function", "transition"
      ]);
    }, d);
  };

  slideToggle = (el, duration = this.options.speed) => {
    if (window.getComputedStyle(el).display === "none") {
      this.slideDown(el, duration);
    } else {
      this.slideUp(el, duration);
    }
  };

  bindAccordion = () => {
    document.querySelectorAll(this.selector).forEach(x => {
      // 既存ハンドラがあれば削除
      if (x._accordionHandler) {
        x.removeEventListener(this.options.event, x._accordionHandler);
      }

      const panel = this.options.target === 'next'
        ? x.nextElementSibling
        : x.previousElementSibling;

      // 初期展開状態
      if (x.classList.contains('--accordion-on') && panel) {
        panel.style.display = this.options.display;
      }

      // クリック（または指定イベント）ハンドラ
      const handler = (e) => {
        // disableLink オプションが true かつ自身が <a> の場合はリンク無効化
        if (this.options.disableLink && x.tagName === 'A') {
          e.preventDefault();
        }
        this.slideToggle(panel, this.options.speed);
        x.classList.toggle('--accordion-on');
      };

      x._accordionHandler = handler;
      x.addEventListener(this.options.event, handler);
    });
    this.enabled = true;
  };

  destroyAccordion = () => {
    document.querySelectorAll(this.selector).forEach(x => {
      if (x._accordionHandler) {
        x.removeEventListener(this.options.event, x._accordionHandler);
        x._accordionHandler = null;
      }
      x.classList.remove('--accordion-on');
      const panel = this.options.target === 'next'
        ? x.nextElementSibling
        : x.previousElementSibling;
      if (panel) {
        panel.style.display = 'none';
      }
    });
    this.enabled = false;
  };

  update = () => {
    const { breakpoint, breakpointType } = this.options;
    let shouldEnable;

    if (!breakpoint) {
      // breakpoint が falsy のときは常に有効
      shouldEnable = true;
    } else if (breakpointType === 'max') {
      shouldEnable = window.innerWidth <= breakpoint;
    } else { // 'min'
      shouldEnable = window.innerWidth >= breakpoint;
    }

    if (shouldEnable && !this.enabled) {
      this.bindAccordion();
    } else if (!shouldEnable && this.enabled) {
      this.destroyAccordion();
    }
  };

  init = () => {
    this.update();
  };

  destroy = () => {
    window.removeEventListener('resize', this.handleResize);
    this.destroyAccordion();
  };
}

export default Accordion;