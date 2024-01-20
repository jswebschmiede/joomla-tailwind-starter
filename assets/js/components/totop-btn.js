(function () {
  class ProgressToTop {
    constructor(element) {
      this.element = element;
      this.progressPath = this.element.querySelector(".svg-content path");
      this.totalLength = this.progressPath.getTotalLength();
      this.setupProgress();
      this.handleScroll();
      this.updateProgressWrap();
      this.updateProgress();
      this.init();
    }

    init = () => {
      this.setupProgress();
      this.handleScroll();
    };

    setupProgress = () => {
      this.progressPath.style.transition = "none";
      this.progressPath.style.strokeDasharray = `${this.totalLength} ${this.totalLength}`;
      this.progressPath.style.strokeDashoffset = this.totalLength;
      this.progressPath.getBoundingClientRect();
      this.progressPath.style.transition = "stroke-dashoffset 10ms linear";

      this.updateProgress();
      window.addEventListener("scroll", this.updateProgress);
    };

    updateProgress = () => {
      const scrollTop = window.scrollY || document.documentElement.scrollTop;
      const windowHeight =
        window.innerHeight || document.documentElement.clientHeight;
      const documentHeight = Math.max(
        document.body.scrollHeight,
        document.documentElement.scrollHeight,
        document.body.offsetHeight,
        document.documentElement.offsetHeight,
        document.body.clientHeight,
        document.documentElement.clientHeight
      );
      const offset =
        this.totalLength -
        (scrollTop * this.totalLength) / (documentHeight - windowHeight);
      this.progressPath.style.strokeDashoffset = offset.toString();
    };

    updateProgressWrap = () => {
      if (window.scrollY > 50) {
        this.element.classList.add("is-shown");
      } else {
        this.element.classList.remove("is-shown");
      }
    };

    handleScroll = () => {
      this.updateProgressWrap();
      window.addEventListener("scroll", this.updateProgressWrap);

      this.element.addEventListener("click", function (event) {
        event.preventDefault();
        window.scrollTo({
          top: 0,
          behavior: "smooth",
        });
        return false;
      });
    };
  }

  const totopBtn = document.querySelector(".progress-wrap");
  if (totopBtn) {
    new ProgressToTop(totopBtn);
  }
})();
