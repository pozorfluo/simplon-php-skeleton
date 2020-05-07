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
    const chat_api_longpoll_url = "?controller=MinichatAPI&action=Long";

    /* initial request to populate msg box */
    fetch(chat_api_url)
      .then(function (response) {
        return response.json();
      })
      .then(function (json_data) {
        refreshContent(minichat, json_data);
      });

    /**
     * todo
     *   - [ ] Make poll_rate inversely proportional to user_count
     *     + [ ] Consider letting server suggest poll_rate in json response
     *     + [ ] Consider delaying response server side anyway since client
     *           could just decide to thrash the API
     */
    // const poll_rate = 3000; /* ms */
    // pollAPI(poll_rate);
    longPollAPI(500);


    /**
     *
     */
    async function longPollAPI(timeout) {
      const response = await fetch(chat_api_longpoll_url);
    //   console.log(response);
      switch (response.status) {
        /* OK */
        case 200:
            console.log("longPollAPI [200]");
          const json_data = await response.json();
          //   console.log(json_data[0]);
          refreshContent(minichat, json_data);
          break;
        /* some kind of connection timeout error */
        case 408:
        case 502:
        case 504:
          console.log("connection timeout : re-connecting");
          break;
        /* NOK */
        default:
          console.log(response.statusText);
          const error_msg = await response.text();
          console.log(error_msg);

          /* hold it before polling again */
          await new Promise((resolve) => setTimeout(resolve, timeout));
          break;
      }
      /* re-connect */
      await longPollAPI(timeout);
    }

    /**
     *
     */
    function refreshContent(target_element, json_data) {
      let str_builder = "";

      for (let i = json_data.length - 1; i >= 0; i--) {
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
        fetch(chat_api_url, {
          method: "POST",
          body: JSON.stringify({
            nickname: msg_box[0].value,
            message: msg_box[1].value,
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
      true
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
    /**
     * note
     *   fetch API recommended method chaining style is a MAJOR SPAGHETTI FEST
     *   ::confused::
     */
    // function pollAPI(timeout) {
    //     return new Promise(function (resolve, reject) {
    //       //------------------------------------------------------ timeout
    //       setTimeout(function () {
    //         //---------------------------------------------- fetch
    //         fetch(chat_api_url, { method: "GET" })
    //           .then(function (response) {
    //             if (response.ok) {
    //               //------------------------------------------- OK
    //               return response.json();
    //             } else {
    //               //------------------------------------------ NOK
    //               return Promise.reject(response);
    //             }
    //           })
    //           //---------------------------------------- handle OK
    //           .then(function (json_data) {
    //             //   console.log(json_data[0]);
    //             refreshContent(minichat, json_data);
    //           })
    //           //------------------------------------- handle error
    //           .catch(function (error) {
    //             console.warn("[error] : Could not refresh minichat.", error);
    //           });
    //         //-------------------------------------------------- call self
    //         pollAPI(timeout);
    //       }, timeout);
    //     });
    //   }