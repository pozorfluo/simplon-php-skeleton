(function () {
  "use strict";

  //------------------------------------------------------------------- main ---
  /**
   * DOMContentLoaded loaded !
   */
  window.addEventListener("DOMContentLoaded", function (event) {
    const minichat = document.querySelector("#hook-console");
    // console.log(minichat);
    //-------------------------------------------- initial json plumbing ---
    let refresh_chat_url = "?controller=MinichatAPI";
    let request = new XMLHttpRequest();

    // request.open("GET", refresh_chat_url);
    // request.responseType = "json";
    // request.send();

    // request.addEventListener("load", function (event) {
    //   //   console.log(request.response);
    //   minichat.textContent = request.response.join("\n");
    // });

    /**
     * todo
     *   - [ ] Make poll_rate inversely proportional to user_count
     *     + [ ] Consider letting server suggest poll_rate in json response
     *     + [ ] Consider delaying response server side anyway since client
     *           could just decide to thrash the API
     */
    const poll_rate = 3000; /* ms */
    pollAPI(poll_rate);

    // function pollAPI(timeout) {
    //   return new Promise(function (resolve, reject) {
    //     setTimeout(function () {
    //       //   request.open("GET", refresh_chat_url);
    //       //   request.responseType = "json";
    //       //   request.send();

    //       pollAPI(timeout);
    //     }, timeout);
    //   });
    // }
    function pollAPI(timeout) {
      return new Promise(function (resolve, reject) {
        setTimeout(function () {
          fetch(refresh_chat_url, { method: "GET" })
            .then(function (response) {
              // console.log(response);
              if (response.ok) {
                return response.json();
              } else {
                return Promise.reject(response);
              }
            })
            .then(function (json_data) {
              minichat.textContent = json_data.join("\n");
            })
            .catch(function (error) {
              console.warn("[error] : Could not refresh minichat.", error);
            });

          pollAPI(timeout);
        }, timeout);
      });
    }

  }); /* DOMContentLoaded */
})(); /* IIFE */
