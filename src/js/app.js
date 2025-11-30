import Navigation from "./lib/navigation";
import stickyContent from "./lib/stickyContent";
import Accordion from "./lib/accordion";
import SmoothScroll from "smooth-scroll";
import Splide from "@splidejs/splide";
import addAltDataImageBlock from "./lib/addAltDataImageBlock";

/* -------------------------------------------------------------------
  utility
------------------------------------------------------------------- */
const smoothScroll = new SmoothScroll('a[href*="#"]', {
  speed: 500,
  speedAsDuration: true,
  popstate: true,
  updateURL: false,
  offset: (anchor, toggle) => {
    if (toggle.href == "#") {
      return 0;
    } else {
      const headerHeight = document.querySelector(".header")
        ? document.querySelector(".header").offsetHeight
        : 0;
      return headerHeight;
    }
  },
});

Navigation("header-nav__btn", "body");
stickyContent("footer", "header");
const altBinder = addAltDataImageBlock();
altBinder.start();

const faq = new Accordion(".js-faq", {
  speed: 400,
  target: "next",
  event: "click",
  display: "flex",
});

document.addEventListener("DOMContentLoaded", () => {
  const homeCaseSplideOptions = {
    type: "loop",
    arrows: false,
    pagination: false,
    rewind: true,
    autoplay: true,
    interval: 5000,
    drag: true,
    fixedWidth: "var(--global-case-item-width)",
    gap: "var(--global-space-low)",
  };
  const homeCaseListClass = ".js-home-carousel";
  const homeCaseList = document.querySelector(homeCaseListClass);
  if (!homeCaseList) return;
  const homeCaseSplide = new Splide(homeCaseListClass, homeCaseSplideOptions);
  homeCaseSplide.mount();
});

document.addEventListener("DOMContentLoaded", () => {
  const featureCaseSplideOptions = {
    type: "loop",
    arrows: false,
    pagination: false,
    rewind: true,
    autoplay: true,
    interval: 5000,
    drag: true,
    focus: "center",
    fixedWidth: "var(--global-case-item-width)",
    gap: "var(--global-space-low)",
  };
  const featureCaseListClass = ".js-feature-case-carousel";
  const featureCaseList = document.querySelector(featureCaseListClass);
  if (!featureCaseList) return;
  const featureCaseSplide = new Splide(
    featureCaseListClass,
    featureCaseSplideOptions
  );
  featureCaseSplide.mount();
});

document.addEventListener("DOMContentLoaded", () => {
  const featureStaffSplideOptions = {
    type: "slide",
    arrows: false,
    pagination: false,
    rewind: true,
    autoplay: true,
    interval: 5000,
    drag: true,
    focus: "center",
    fixedWidth: "var(--global-staff-item-width)",
    gap: "var(--global-space-low)",
    padding: "var(--global-space-padding-inline)",
    mediaQuery: "min",
    breakpoints: {
      1024: {
        destroy: true,
      },
    },
  };
  const featureStaffListClass = ".js-feature-staff-carousel";
  const featureStaffList = document.querySelector(featureStaffListClass);
  if (!featureStaffList) return;
  const featureStaffSplide = new Splide(
    featureStaffListClass,
    featureStaffSplideOptions
  );
  featureStaffSplide.mount();
});
