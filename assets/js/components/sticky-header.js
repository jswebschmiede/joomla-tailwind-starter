(() => {
  class StickyHeader {
    constructor(
      element,
      options = {
        scrollThreshold: 200,
        isScrollTo: false,
        scrollMarginTop: 112,
      },
    ) {
      this.element = element;
      this.options = { ...StickyHeader.defaultOptions, ...options };
      this.scrollThreshold = this.options.scrollThreshold;
      this.headerHeight = this.element.offsetHeight * 2;
      this.element.style = `--header-height: -${this.headerHeight}px`;
      this.isSticky = false;
      this.scrollTimeout = null;
      this.placeholder = null;

      this.handleScroll = this.handleScroll.bind(this);
      this.setScrollMargin();
      this.initEventListeners();
      this.handleScroll();
    }

    static defaultOptions = {
      scrollThreshold: 200,
      isScrollTo: false,
      scrollMarginTop: 112,
    };

    initEventListeners() {
      window.addEventListener("scroll", this.handleScroll);
    }

    handleScroll() {
      const isNearThreshold = window.scrollY > this.scrollThreshold - 50;
      const isOverThreshold = window.scrollY >= this.scrollThreshold;

      this.togglePlaceholder(isOverThreshold);

      this.element.classList.toggle("slide-in", isNearThreshold);
      this.element.classList.toggle("is-sticky", isOverThreshold);
      this.element.classList.toggle("slide-out", isOverThreshold);

      this.isSticky = isOverThreshold;

      if (this.options.isScrollTo) {
        this.handleScrollTo();
      }
    }

    togglePlaceholder(isOverThreshold) {
      if (isOverThreshold && !this.placeholder) {
        this.createPlaceholder();
      } else if (!isOverThreshold && this.placeholder) {
        this.removePlaceholder();
      }
    }

    createPlaceholder() {
      this.placeholder = document.createElement("div");
      this.placeholder.style.height = `${this.element.offsetHeight}px`;
      this.element.parentNode.insertBefore(this.placeholder, this.element);
    }

    removePlaceholder() {
      this.placeholder.remove();
      this.placeholder = null;
    }

    handleScrollTo() {
      clearTimeout(this.scrollTimeout);

      this.scrollTimeout = setTimeout(() => {
        const sections = Array.from(document.querySelectorAll("section[id]"));
        const navLinks = Array.from(document.querySelectorAll(".header__link"));
        const currentSectionId = this.getCurrentSectionId(sections);

        navLinks.forEach((link) => {
          link.classList.toggle(
            "active",
            link.getAttribute("href") === "#" + currentSectionId,
          );
        });
      }, 50); // delay
    }

    getCurrentSectionId(sections) {
      for (let i = sections.length - 1; i >= 0; i--) {
        const section = sections[i];
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;
        if (window.scrollY >= sectionTop - sectionHeight / 3) {
          return section.id;
        }
      }

      return null;
    }

    setScrollMargin() {
      const sectionIds = Array.from(
        document.querySelectorAll("section[id]"),
      ).map((section) => section.id);

      sectionIds.forEach((id) => {
        const section = document.getElementById(id);
        section.style.scrollMarginTop = `${this.options.scrollMarginTop}px`;
      });
    }
  }

  const stickyHeader = document.querySelector(".f-header--sticky");
  if (stickyHeader) {
    new StickyHeader(stickyHeader, { scrollThreshold: 300 });
  }
})();
