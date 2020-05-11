# tp product-hunt
![simplon-tp-product-hunt](htdocs/resources/images/tp-product-hunt.svg)

## todo
- [ ] Use producthunt.com api reference as a starting point to sketch db
  + [ ] Sample some posts, users, comments data
- [ ] Add decisions log column to trello board
- [ ] Sketch diagram of the app

## decisions log
- Follow PSR-1 and PSR-12 coding standards.
- Separate backend API and backend dynamic page generation.
    + backend API MUST use strict typing.
    + backend dynamic page generation SHOULD use strict typing.
    + backend dynamic page generation MUST NOT interact directly with the
      database and MUST use the backend API to get its data.
    + The App MAY use a single point of entry and a dispatcher to route requests
- Use Ajax requests directed at the backend API to update page on the client
  and display modals.


## reference links
https://api.producthunt.com/v2/docs  
https://ph-graph-api-explorer.herokuapp.com/  
http://api-v2-docs.producthunt.com.s3-website-us-east-1.amazonaws.com/operation/query/  
https://github.com/producthunt/producthunt-api  
https://graphql.org/learn/serving-over-http/


## sample data
#### some users
#### some comments
#### first 10 posts
```graphQL
{
  posts(first: 10) {
    edges {
      node {
        commentsCount
        createdAt
        description
        featuredAt
        id
        isCollected
        isVoted
        makers {
          id
          username
        }
        media {
          type
          url
          videoUrl
        }
        name
        productLinks {
          type
          url
        }
        reviewsCount
        reviewsRating
        slug
        tagline
        thumbnail {
          type
          url
          videoUrl
        }
        url
        user {
          id
          username
        }
        userId
        votesCount
        website
      }
    }
  }
}
```

```json
{
  "data": {
    "posts": {
      "edges": [
        {
          "node": {
            "commentsCount": 7,
            "createdAt": "2020-05-10T07:01:00Z",
            "description": "Rewind displays your bookmarks filtered by date, with thumbnails and instant search. It takes one click to see the links you saved yesterday, last week, last month. It's totally free and it relies on your local bookmarks, you don't have to create an account.",
            "featuredAt": "2020-05-10T07:01:00Z",
            "id": "199004",
            "isCollected": false,
            "isVoted": false,
            "makers": [
              {
                "id": "238262",
                "username": "j_____________n"
              }
            ],
            "media": [
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/a892b3b3-0397-44ac-b2c2-f583f7d8f668?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/95dcfbac-e159-48e4-91aa-f21933e14570?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/8a4f4f3c-7852-47f6-b675-b62db455e0bf?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/c5bfce52-32c6-4913-91fb-95d2c21b597e?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/f500d84f-b9dc-47e0-aa54-d43ed79d09e3?auto=format&fit=crop",
                "videoUrl": null
              }
            ],
            "name": "Rewind",
            "productLinks": [
              {
                "type": "Chrome",
                "url": "https://www.producthunt.com/r/e718e193be7e0e?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
              },
              {
                "type": "Website",
                "url": "https://www.producthunt.com/r/19410258200dd2?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
              }
            ],
            "reviewsCount": 3,
            "reviewsRating": 3.3,
            "slug": "rewind-3",
            "tagline": "Your bookmarks, by date, with thumbnails and instant search",
            "thumbnail": {
              "type": "image",
              "url": "https://ph-files.imgix.net/f500d84f-b9dc-47e0-aa54-d43ed79d09e3?auto=format&fit=crop",
              "videoUrl": null
            },
            "url": "https://www.producthunt.com/posts/rewind-3?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29",
            "user": {
              "id": "18280",
              "username": "chrismessina"
            },
            "userId": "18280",
            "votesCount": 112,
            "website": "https://www.producthunt.com/r/19410258200dd2?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
          }
        },
        {
          "node": {
            "commentsCount": 5,
            "createdAt": "2020-05-10T07:00:00Z",
            "description": "Buy For Life is a crowdsourced platform to discuss and discover long-lasting and sustainable products.",
            "featuredAt": "2020-05-10T07:00:00Z",
            "id": "198980",
            "isCollected": false,
            "isVoted": false,
            "makers": [
              {
                "id": "1057051",
                "username": "krebs_adrian"
              }
            ],
            "media": [
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/2a459cfc-29c6-4260-9d65-7fb79766940f?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/0bb45a02-be82-46ab-a33b-9cb64ce8a9a5?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/72722b4c-b2fe-4dc8-94ef-dbcf915e6d1c?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/ffd67a36-a2ef-4e78-8baf-52c0c08f5533?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/86d27195-ec0c-4d83-99d2-eccae99a9101?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/6a3fd5b4-a446-4a40-a349-0ba09363e77d?auto=format&fit=crop",
                "videoUrl": null
              }
            ],
            "name": "Buy For Life",
            "productLinks": [
              {
                "type": "Website",
                "url": "https://www.producthunt.com/r/9eebfd7d297bc0?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
              }
            ],
            "reviewsCount": 0,
            "reviewsRating": 0,
            "slug": "buy-for-life-2",
            "tagline": "Discover durable and sustainable products for a better world",
            "thumbnail": {
              "type": "image",
              "url": "https://ph-files.imgix.net/86d27195-ec0c-4d83-99d2-eccae99a9101?auto=format&fit=crop",
              "videoUrl": null
            },
            "url": "https://www.producthunt.com/posts/buy-for-life-2?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29",
            "user": {
              "id": "514245",
              "username": "calum"
            },
            "userId": "514245",
            "votesCount": 82,
            "website": "https://www.producthunt.com/r/9eebfd7d297bc0?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
          }
        },
        {
          "node": {
            "commentsCount": 7,
            "createdAt": "2020-05-10T07:01:00Z",
            "description": "Remoty help teams reach their full potential with powerful time-tracking and progress update workflow in Slack.",
            "featuredAt": "2020-05-10T07:07:41Z",
            "id": "198982",
            "isCollected": false,
            "isVoted": false,
            "makers": [
              {
                "id": "2511700",
                "username": "muhammad_owais2"
              },
              {
                "id": "2501301",
                "username": "mahad_ahmad_"
              }
            ],
            "media": [
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/c9dce6e0-1ea7-47fb-b082-bd6bad118e5e?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/e398c266-e9b4-4223-8652-fdd58b2cbc7f?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/d629391b-6c2c-4efa-a623-6200a05998bd?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/2148cce6-b10b-4f08-8e3a-6b7b713ba0a7?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/f8f2f76e-5aa6-4d11-baca-663f0532cc85?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/6b5a688a-28a7-4936-86d4-2e1d4b708c29?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/b99b07d4-c6fe-4c1b-92b3-46b919f8a703?auto=format&fit=crop",
                "videoUrl": null
              }
            ],
            "name": "Remoty",
            "productLinks": [
              {
                "type": "Website",
                "url": "https://www.producthunt.com/r/d2ecdffbb5e24a?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
              }
            ],
            "reviewsCount": 1,
            "reviewsRating": 5,
            "slug": "remoty",
            "tagline": "Time tracking, async daily standups  & payroll exports",
            "thumbnail": {
              "type": "image",
              "url": "https://ph-files.imgix.net/6b5a688a-28a7-4936-86d4-2e1d4b708c29?auto=format&fit=crop",
              "videoUrl": null
            },
            "url": "https://www.producthunt.com/posts/remoty?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29",
            "user": {
              "id": "2501301",
              "username": "mahad_ahmad_"
            },
            "userId": "2501301",
            "votesCount": 82,
            "website": "https://www.producthunt.com/r/d2ecdffbb5e24a?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
          }
        },
        {
          "node": {
            "commentsCount": 11,
            "createdAt": "2020-05-10T07:12:00Z",
            "description": "WA for everyone who plans the wedding and wedding professionals. 🥑 Useful tools of the wedding projects 💪🏼 Collaborate in real-time 🎯 Cloud storage, easy sharing 🚀 Marketing tools for vendors and venues 🌻 Multiple languages supported 😎 Security first!",
            "featuredAt": "2020-05-10T07:17:50Z",
            "id": "198891",
            "isCollected": false,
            "isVoted": false,
            "makers": [
              {
                "id": "120999",
                "username": "vadimuz"
              }
            ],
            "media": [
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/7735dd88-a40d-4f0e-9b94-bf8d6f701747?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/bdb09ffd-9348-4f17-8592-3b8fd589227c?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/a259f276-2bef-4514-b754-25b4db777d27?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/0009f71a-0e07-4256-9701-adf3178c4ca2?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/c6a4ffa9-95ed-46ad-8311-7a8a707bde0e?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/8ae20a12-56c6-4f43-8968-03226ca705c4?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/aa2ce5f0-9a6b-4629-902c-637da65cde69?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/45f7fd58-9448-42e9-a9c0-86920dffcfd0?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/780a3e5d-0db2-4619-9a0f-a812c7181ea9?auto=format&fit=crop",
                "videoUrl": null
              }
            ],
            "name": "Wedding Planning Assistant",
            "productLinks": [
              {
                "type": "Website",
                "url": "https://www.producthunt.com/r/5ba83f554101bf?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
              }
            ],
            "reviewsCount": 7,
            "reviewsRating": 5,
            "slug": "wedding-planning-assistant",
            "tagline": "Everything you need to plan your wedding",
            "thumbnail": {
              "type": "image",
              "url": "https://ph-files.imgix.net/45f7fd58-9448-42e9-a9c0-86920dffcfd0?auto=format&fit=crop",
              "videoUrl": null
            },
            "url": "https://www.producthunt.com/posts/wedding-planning-assistant?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29",
            "user": {
              "id": "120999",
              "username": "vadimuz"
            },
            "userId": "120999",
            "votesCount": 120,
            "website": "https://www.producthunt.com/r/5ba83f554101bf?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
          }
        },
        {
          "node": {
            "commentsCount": 4,
            "createdAt": "2020-05-10T07:00:00Z",
            "description": "Join conference calls in 1 sec. Usually, it takes about a minute to find the right URL and connect to the meeting. Time to change it. Especially right now.",
            "featuredAt": "2020-05-10T07:00:00Z",
            "id": "198888",
            "isCollected": false,
            "isVoted": false,
            "makers": [
              {
                "id": "66817",
                "username": "butaji"
              }
            ],
            "media": [
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/f7b3eb80-771e-4e30-b1d9-ce7b12b4c58f?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/34932513-d20b-4e9a-b413-3d333e7c0615?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/8b4aab5c-63cd-4e6d-a070-ee93f37616a4?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/0025f5a1-d791-4b42-955d-711a7d7b1ee7?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/bdddd402-5937-498e-89bb-eb1057dbc8ab?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/e3664b20-61aa-47b0-ac69-2dbbd84301a6?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/ace19760-48a2-4384-9ae0-6fc426a9bb29?auto=format&fit=crop",
                "videoUrl": null
              }
            ],
            "name": "Jump In Meeting",
            "productLinks": [
              {
                "type": "App Store",
                "url": "https://www.producthunt.com/r/ea76f4e0bb2353?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
              },
              {
                "type": "App Store",
                "url": "https://www.producthunt.com/r/20c5f2059d333d?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
              },
              {
                "type": "Website",
                "url": "https://www.producthunt.com/r/1306a22396b5bd?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
              }
            ],
            "reviewsCount": 0,
            "reviewsRating": 0,
            "slug": "jump-in-meeting",
            "tagline": "Connect to your conference calls from the menu bar",
            "thumbnail": {
              "type": "image",
              "url": "https://ph-files.imgix.net/e3664b20-61aa-47b0-ac69-2dbbd84301a6?auto=format&fit=crop",
              "videoUrl": null
            },
            "url": "https://www.producthunt.com/posts/jump-in-meeting?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29",
            "user": {
              "id": "66817",
              "username": "butaji"
            },
            "userId": "66817",
            "votesCount": 64,
            "website": "https://www.producthunt.com/r/1306a22396b5bd?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
          }
        },
        {
          "node": {
            "commentsCount": 4,
            "createdAt": "2020-05-08T19:45:51Z",
            "description": "Check the price automatically at over 30,000 retailers instantly when you visit any product. Know every retailer's price before choosing which to buy from. Important details like arrival date and estimated shipping cost are also shown, compare it all!",
            "featuredAt": "2020-05-10T07:44:03Z",
            "id": "198664",
            "isCollected": false,
            "isVoted": false,
            "makers": [
              {
                "id": "208572",
                "username": "schmylan"
              },
              {
                "id": "208493",
                "username": "johnsboyd"
              },
              {
                "id": "2383141",
                "username": "jake_marsh2"
              }
            ],
            "media": [
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/e428f419-1384-4261-a821-16cf8ca4ba08?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/d19848db-5b41-425b-9785-1e7d01f0da9f?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/9f654d77-2b04-4d9d-bfe3-cfd71472e3c5?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/f240b69f-8f97-48ec-af53-be1da12805fb?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/36105193-33b7-40f9-98b6-2d09171013cc?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/500a26c0-f65a-4ba1-9063-4a3490a6b663?auto=format&fit=crop",
                "videoUrl": null
              }
            ],
            "name": "ShopSavvy for Chrome",
            "productLinks": [
              {
                "type": "Chrome",
                "url": "https://www.producthunt.com/r/d9f1ac2c97fe91?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
              }
            ],
            "reviewsCount": 3,
            "reviewsRating": 5,
            "slug": "shopsavvy-for-chrome",
            "tagline": "Automatically compare prices between over 30,000+ retailers.",
            "thumbnail": {
              "type": "image",
              "url": "https://ph-files.imgix.net/36105193-33b7-40f9-98b6-2d09171013cc?auto=format&fit=crop",
              "videoUrl": null
            },
            "url": "https://www.producthunt.com/posts/shopsavvy-for-chrome?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29",
            "user": {
              "id": "2383141",
              "username": "jake_marsh2"
            },
            "userId": "2383141",
            "votesCount": 55,
            "website": "https://www.producthunt.com/r/d9f1ac2c97fe91?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
          }
        },
        {
          "node": {
            "commentsCount": 13,
            "createdAt": "2020-05-10T07:00:00Z",
            "description": "9to5Mac featured productivity app Was it hangouts or zoom? Personal or work calendar? Cut through the noise by simply connecting your calendar, and Meeter will automatically pull all your upcoming calls and let you manage them in one place.",
            "featuredAt": "2020-05-10T07:00:00Z",
            "id": "198553",
            "isCollected": false,
            "isVoted": false,
            "makers": [
              {
                "id": "2541246",
                "username": "patrice_becker"
              }
            ],
            "media": [
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/cb2d77e4-fb15-4c90-b3e3-fa60d7845754?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/3c3a766d-132c-44f3-9bde-f00c6998a70c?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/53787439-8ecf-4ff1-bbd6-6006b5e3f29b?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/a4f77236-ea5a-4599-9bf8-c08dd99668cc?auto=format&fit=crop",
                "videoUrl": null
              }
            ],
            "name": "Meeter",
            "productLinks": [
              {
                "type": "App Store",
                "url": "https://www.producthunt.com/r/aa750c9708c4e8?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
              },
              {
                "type": "Website",
                "url": "https://www.producthunt.com/r/b951cc57adb5dd?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
              }
            ],
            "reviewsCount": 3,
            "reviewsRating": 5,
            "slug": "meeter",
            "tagline": "Hop in and out of calls, directly from your menu bar",
            "thumbnail": {
              "type": "image",
              "url": "https://ph-files.imgix.net/53787439-8ecf-4ff1-bbd6-6006b5e3f29b?auto=format&fit=crop",
              "videoUrl": null
            },
            "url": "https://www.producthunt.com/posts/meeter?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29",
            "user": {
              "id": "2541186",
              "username": "lenni_soenke"
            },
            "userId": "2541186",
            "votesCount": 104,
            "website": "https://www.producthunt.com/r/b951cc57adb5dd?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
          }
        },
        {
          "node": {
            "commentsCount": 5,
            "createdAt": "2020-05-06T06:40:19Z",
            "description": "OffScreen 2.0 has a major update to help people focus on what matters when you working/studying from home. Less screen time can reduce your anxiety obviously. Pomodoro timer, Focus data analysis, Screen time calendar... and many more can improve your workflow",
            "featuredAt": "2020-05-10T07:56:31Z",
            "id": "197880",
            "isCollected": false,
            "isVoted": false,
            "makers": [
              {
                "id": "67038",
                "username": "liuyi0922"
              },
              {
                "id": "14706",
                "username": "creativewang"
              }
            ],
            "media": [
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/314b8e0a-ae26-4fc9-9522-54a39b4ea5ec?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/6e5cc462-8e6e-4a83-9c1f-eb340f2ed445?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/3e740139-d591-4fe1-96ae-4eb36c9d6baa?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/a7e355bf-b79b-4ab4-b306-5ed5243e1bba?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/5f164d3b-96be-44e8-ad2d-99cc304a4803?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/2f47e254-4515-4858-a358-758d7b4ff172?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/57909e88-54c3-40de-a980-c01e90f7bf4c?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/fdcd37f9-7399-4afc-9e43-08b7429ae371?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/1e30b0b6-d8e0-4bf2-b620-99966a451a17?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/e01460fe-d709-4637-92f3-11a85f90fded?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/447e6dc2-70c4-4e3e-8c52-2dd38f9f032c?auto=format&fit=crop",
                "videoUrl": null
              }
            ],
            "name": "OffScreen 2.0",
            "productLinks": [
              {
                "type": "App Store",
                "url": "https://www.producthunt.com/r/65a6ba8d82443c?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
              }
            ],
            "reviewsCount": 1,
            "reviewsRating": 5,
            "slug": "offscreen-2-0",
            "tagline": "Less screen time, more focus.",
            "thumbnail": {
              "type": "image",
              "url": "https://ph-files.imgix.net/e01460fe-d709-4637-92f3-11a85f90fded?auto=format&fit=crop",
              "videoUrl": null
            },
            "url": "https://www.producthunt.com/posts/offscreen-2-0?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29",
            "user": {
              "id": "14706",
              "username": "creativewang"
            },
            "userId": "14706",
            "votesCount": 78,
            "website": "https://www.producthunt.com/r/65a6ba8d82443c?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
          }
        },
        {
          "node": {
            "commentsCount": 1,
            "createdAt": "2020-05-06T12:52:02Z",
            "description": "We all do a lot of scrolling in our browsers. If you could convert pixels to mi/km, how far would you scroll each day? This extension attempts to answer that question. (And maybe help us think more about standing up and logging some actual miles.)",
            "featuredAt": "2020-05-10T07:10:30Z",
            "id": "197988",
            "isCollected": false,
            "isVoted": false,
            "makers": [
              {
                "id": "109295",
                "username": "prashantbaid"
              }
            ],
            "media": [
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/e7d69e5f-944e-4ceb-835c-32126309a97b?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/fb3d79b1-88da-43b4-ab90-caa75eb1f0b4?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/23da0765-2c35-4b66-a80b-577a51f3ecae?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/239ba195-022c-475c-850c-ef6695f57c90?auto=format&fit=crop",
                "videoUrl": null
              }
            ],
            "name": "ScrollTrotter",
            "productLinks": [
              {
                "type": "Chrome",
                "url": "https://www.producthunt.com/r/121fb3797b26be?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
              }
            ],
            "reviewsCount": 3,
            "reviewsRating": 5,
            "slug": "scrolltrotter",
            "tagline": "How many miles have you scrolled today?",
            "thumbnail": {
              "type": "image",
              "url": "https://ph-files.imgix.net/23da0765-2c35-4b66-a80b-577a51f3ecae?auto=format&fit=crop",
              "videoUrl": null
            },
            "url": "https://www.producthunt.com/posts/scrolltrotter?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29",
            "user": {
              "id": "745",
              "username": "lloyddobbler"
            },
            "userId": "745",
            "votesCount": 60,
            "website": "https://www.producthunt.com/r/121fb3797b26be?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
          }
        },
        {
          "node": {
            "commentsCount": 1,
            "createdAt": "2020-05-10T08:01:00Z",
            "description": "A free time blocking app that works with Google Calendar. Calendarist gives you a clear picture of your daily life and keeps you on track to reach your goals.",
            "featuredAt": "2020-05-10T09:08:35Z",
            "id": "198802",
            "isCollected": false,
            "isVoted": false,
            "makers": [
              {
                "id": "2576028",
                "username": "emilyemsu"
              }
            ],
            "media": [
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/e0fe0e60-3a79-42e8-9410-2c19ee7e39e2?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/23e9bc8c-6573-4443-b4f1-6c5ea2823cbb?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/39f568c2-4867-41bc-ae5b-098d9d23a4ac?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/0b55659b-5a4d-44ad-b21f-ad26efdb56ea?auto=format&fit=crop",
                "videoUrl": null
              },
              {
                "type": "image",
                "url": "https://ph-files.imgix.net/f007f7e3-9faa-4943-970a-e362c126a694?auto=format&fit=crop",
                "videoUrl": null
              }
            ],
            "name": "Calendarist",
            "productLinks": [
              {
                "type": "Website",
                "url": "https://www.producthunt.com/r/fd79262fcda3d8?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
              }
            ],
            "reviewsCount": 0,
            "reviewsRating": 0,
            "slug": "calendarist",
            "tagline": "Time blocking companion for Google Calendar",
            "thumbnail": {
              "type": "image",
              "url": "https://ph-files.imgix.net/0b55659b-5a4d-44ad-b21f-ad26efdb56ea?auto=format&fit=crop",
              "videoUrl": null
            },
            "url": "https://www.producthunt.com/posts/calendarist?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29",
            "user": {
              "id": "2576028",
              "username": "emilyemsu"
            },
            "userId": "2576028",
            "votesCount": 29,
            "website": "https://www.producthunt.com/r/fd79262fcda3d8?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
          }
        }
      ]
    }
  }
}
```



















```graphQL
{
  posts(first: 5) {
    edges {
      node {
        id
        name
        collections {
          edges {
            node {
              id
              name
            }
          }
        }
      }
    }
  }
}
```



```json
{
  "data": null,
  "errors": [
    {
      "error": "rate_limit_reached",
      "error_description": "Sorry. You have exceeded the API rate limit, please try again later.",
      "details": {
        "limit": 25000,
        "remaining": -8,
        "reset_in": 109
      }
    }
  ]
}
```

```graphQL
{
  posts(first: 5) {
    edges {
      node {
        id
        name
        commentsCount
        votesCount
        website
      }
    }
  }
}
```

```json
{
  "data": {
    "posts": {
      "edges": [
        {
          "node": {
            "id": "199004",
            "name": "Rewind",
            "commentsCount": 3,
            "votesCount": 95,
            "website": "https://www.producthunt.com/r/19410258200dd2?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
          }
        },
        {
          "node": {
            "id": "198980",
            "name": "Buy For Life",
            "commentsCount": 5,
            "votesCount": 72,
            "website": "https://www.producthunt.com/r/9eebfd7d297bc0?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
          }
        },
        {
          "node": {
            "id": "198891",
            "name": "Wedding Planning Assistant",
            "commentsCount": 11,
            "votesCount": 112,
            "website": "https://www.producthunt.com/r/5ba83f554101bf?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
          }
        },
        {
          "node": {
            "id": "198982",
            "name": "Remoty",
            "commentsCount": 7,
            "votesCount": 68,
            "website": "https://www.producthunt.com/r/d2ecdffbb5e24a?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
          }
        },
        {
          "node": {
            "id": "198888",
            "name": "Jump In Meeting",
            "commentsCount": 3,
            "votesCount": 56,
            "website": "https://www.producthunt.com/r/1306a22396b5bd?utm_campaign=producthunt-api&utm_medium=api-v2&utm_source=Application%3A+PH+API+Explorer+%28ID%3A+9162%29"
          }
        }
      ]
    }
  }
}
```