/*
Usage: addAltDataImageBlock.js
---
import addAltDataImageBlock from './lib/addAltDataImageBlock';

const altBinder = addAltDataImageBlock();
altBinder.start();
*/

const addAltDataImageBlock = () => {
  const SELECTOR = "figure.is-style-label";
  const boundImgs = new WeakSet();

  const applyAlt = (figure) => {
    if (!figure || !figure.matches(SELECTOR)) return;
    const img = figure.querySelector("img");
    if (!img) return;

    figure.dataset.alt = typeof img.alt === "string" ? img.alt : "";

    if (boundImgs.has(img)) return;

    img.addEventListener("load", () => {
      figure.dataset.alt = img.alt || "";
    });

    const imgObserver = new MutationObserver((mutations) => {
      for (const m of mutations) {
        if (m.type === "attributes" && m.attributeName === "alt") {
          figure.dataset.alt = img.alt || "";
        }
      }
    });
    imgObserver.observe(img, { attributes: true, attributeFilter: ["alt"] });
    img.__altDataObserver = imgObserver;
    boundImgs.add(img);
  };

  const processFigure = (figure) => {
    if (!(figure instanceof Element)) return;
    if (!figure.matches(SELECTOR)) return;
    applyAlt(figure);
  };

  const init = () => {
    document.querySelectorAll(SELECTOR).forEach(processFigure);
  };

  const docObserver = new MutationObserver((mutations) => {
    for (const m of mutations) {
      if (m.type === "childList") {
        m.addedNodes.forEach((node) => {
          if (!(node instanceof Element)) return;

          if (node.matches?.(SELECTOR)) processFigure(node);
          node.querySelectorAll?.(SELECTOR).forEach(processFigure);

          if (node.matches?.("img")) {
            const fig = node.closest?.(SELECTOR);
            if (fig) applyAlt(fig);
          } else {
            node.querySelectorAll?.("img").forEach((img) => {
              const fig = img.closest?.(SELECTOR);
              if (fig) applyAlt(fig);
            });
          }
        });
      }

      if (m.type === "attributes" && m.attributeName === "class") {
        const el = m.target;
        if (el instanceof Element && el.matches?.(SELECTOR)) {
          processFigure(el);
        }
      }
    }
  });

  const start = () => {
    init();
    docObserver.observe(document.documentElement, {
      childList: true,
      subtree: true,
      attributes: true,
      attributeFilter: ["class"],
    });
  };

  const stop = () => {
    docObserver.disconnect();
    document.querySelectorAll(`${SELECTOR} img`).forEach((img) => {
      if (img.__altDataObserver) {
        img.__altDataObserver.disconnect();
        delete img.__altDataObserver;
      }
    });
  };

  return { start, stop };
};

export { addAltDataImageBlock as default };
