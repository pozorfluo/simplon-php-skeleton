(function () {
  "use strict";

  //------------------------------------------------------------------- main ---
  /**
   * DOMContentLoaded loaded !
   */
  window.addEventListener("DOMContentLoaded", function (event) {
    const minichat = document.querySelector("#hook-console");
    const msg_box = document.querySelector("#hook-msg-box");

    //-------------------------------------------- initial json plumbing ---
    const refresh_chat_url = "?controller=MinichatAPI";
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
          fetch(refresh_chat_url, { method: "GET" })
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

    function refreshContent(target_element, json_data) {
      let str_builder = "";

      for (let i = 0, length = json_data.length; i < length; i++) {
        str_builder +=
          `[${json_data[i].created_at.substr(10)}]` +
          ` ${json_data[i].nickname} said :\n` +
          `\t${json_data[i].message}\n`;
      }
      target_element.textContent = str_builder;
    }
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
