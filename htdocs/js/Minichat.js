(function () {
  "use strict";

  //------------------------------------------------------------------- main ---
  /**
   * DOMContentLoaded loaded !
   */
  window.addEventListener("DOMContentLoaded", function (event) {
    const minichat = document.querySelector("#hook-console");
    const msg_box = document.querySelector(".minichat-form");

    //-------------------------------------------- initial json plumbing ---
    const chat_api_url = "?controller=MinichatAPI";
    // request.addEventListener("load", function (event) {
    //     console.log(request.response);
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

    /**
     * note
     *   fetch API recommended method chaining style is a MAJOR SPAGHETTI FEST
     *   ::confused::
     */
    function pollAPI(timeout) {
      return new Promise(function (resolve, reject) {
        //------------------------------------------------------ timeout
        setTimeout(function () {
          //---------------------------------------------- fetch
          fetch(chat_api_url, { method: "GET" })
            .then(function (response) {
              if (response.ok) {
                //------------------------------------------- OK
                return response.json();
              } else {
                //------------------------------------------ NOK
                return Promise.reject(response);
              }
            })
            //---------------------------------------- handle OK
            .then(function (json_data) {
              //   console.log(json_data[0]);
              refreshContent(minichat, json_data);
            })
            //------------------------------------- handle error
            .catch(function (error) {
              console.warn("[error] : Could not refresh minichat.", error);
            });
          //-------------------------------------------------- call self
          pollAPI(timeout);
        }, timeout);
      });
    }

    /**
     *
     */
    function refreshContent(target_element, json_data) {
      let str_builder = "";

      for (let i = json_data.length - 1 ; i >= 0; i--) {
        str_builder +=
          `[${json_data[i].created_at.substr(10)}]` +
          ` ${json_data[i].nickname} said :\n` +
          `\t${json_data[i].message}\n`;
      }
      target_element.textContent = str_builder;
    }

    /**
     *
     */
    msg_box.addEventListener(
      "submit",
      function (event) {
        // console.log(event.target[0].value);
        // console.log(event.target[1].value);
        // console.log(
        //   JSON.stringify({
        //     nickname: event.target[0].value,
        //     message: event.target[1].value,
        //   })
        // );

        fetch(chat_api_url, {
          method: "POST",
          body: JSON.stringify({
            nickname: event.target[0].value,
            message: event.target[1].value,
          }),
        })
          .then(function (response) {
            return response.text();
          })
          .then(function (json_data) {
            console.log(json_data);
          });

        event.preventDefault();
      },
      false
    );
    //------------------------------------- press enter in msg-box to submit
    // msg_box.addEventListener("focus", function (event) {}, false);
    // msg_box.addEventListener("blur", function (event) {}, false);
    // msg_box.addEventListener("keyup", function (event) {
    //     if (event.key === 'enter') {
    //         console.log('send');
    //     }
    // }, false);
  }); /* DOMContentLoaded */
})(); /* IIFE */

// const request = new XMLHttpRequest();
// request.open("GET", refresh_chat_url);
// request.responseType = "json";
// request.send();

// request.addEventListener("load", function (event) {
//     console.log(request.response);
//   minichat.textContent = request.response.join("\n");
// });

// function pollAPI(timeout) {
//   return new Promise(function (resolve, reject) {
//     setTimeout(function () {
//       request.open("GET", refresh_chat_url);
//       request.responseType = "json";
//       request.send();

//       pollAPI(timeout);
//     }, timeout);
//   });
// }
