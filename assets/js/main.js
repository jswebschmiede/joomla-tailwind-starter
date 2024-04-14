import "./components/preloader";
import "./components/joomla";
import "./components/progress-to-top";
import "./components/reveal-effects";
import "./components/anim-menu-btn";
import "./components/flexi-header";
import StickyHeader from "./components/sticky-header";

// init
(() => {
  const stickyHeader = document.querySelector(".f-header--sticky");
  if (stickyHeader) {
    new StickyHeader(stickyHeader);
  }
})();
