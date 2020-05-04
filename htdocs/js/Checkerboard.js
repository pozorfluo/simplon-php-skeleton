(function () {
  "use strict";

  function getRandomColorHex(span = 16, offset = 0) {
    offset = Math.max(Math.min(16, offset), 0);
    span = Math.max(Math.min(16 - offset, span), 0);
    return "#DD0000".replace(/0/g, function () {
      return (Math.floor(Math.random() * span) + offset).toString(16);
    });
  }

  /**
   * Generate and then cycle through own random color array of given length
   */
  function* cycleColor(length) {
    const colors = [];
    for (let i = 0; i < length; i++) {
      colors.push(getRandomColorHex(16, 5));
    }

    for (let i = 0; ; i++) {
      yield colors[i >= length ? (i = 0) : i];
    }
  }

  function testAlert(msg = "hello, hello, hello") {
    alert(msg);
  }

  function squareClick(event, color) {
    event.currentTarget.style.backgroundColor = color;
  }

  //------------------------------------------------------------------- main ---
  /**
   * DOMContentLoaded loaded !
   * 
   * todo
   *   - [ ] Check your own gradient onhover generator demo, it was much more
   *         responsive
   */
  window.addEventListener("DOMContentLoaded", function (event) {
    // static node array
    const squares = [...document.querySelectorAll(".square")];
    const square_container = document.querySelector(".square-container");
    const color_cycler = cycleColor(11);
    square_container.style.backgroundColor = color_cycler.next().value;

    for (let i = 0, length = squares.length; i < length; i++) {
      squares[i].style.backgroundColor = color_cycler.next().value;

      //------------------------------------------------------------ click
      squares[i].addEventListener(
        "click",
        function (event) {
          squareClick(event, color_cycler.next().value);
        },
        false
      );

      //------------------------------------------------------------ hover
      squares[i].addEventListener(
        "mouseover",
        function (event) {
          const color = event.currentTarget.style.backgroundColor;
        //   this.addEventListener(
        //     "transitionend",
        //     function (event) {
        //       squareClick(event, color_cycler.next().value);
        //     },
        //     { once: true }
        //   );
        },
        false
      );
      squares[i].addEventListener(
        "mouseleave",
        function (event) {
          squareClick(event, color_cycler.next().value);
        },
        false
      );
    }
  });
})();
