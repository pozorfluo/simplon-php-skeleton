# mock a post
curl --header "Content-Type: application/json" \
    --request POST \
    --data '{"nickname" : "qdqdqz", "message":"hello qsdsqd curl" }' \
    "http://hello-php.loc/?controller=MinichatAPI"

# mock a post on live site
curl --header "Content-Type: application/json" \
    --request POST \
    --data '{"nickname" : "qdqdqz", "message":"hello qsdsqd curl" }' \
    "http://emjjjpl.cluster029.hosting.ovh.net/?controller=MinichatAPI"


curl "http://hello-php.loc/?controller=ConcreteAPI&action=Long"
curl "http://hello-php.loc/?controller=ConcreteAPI"


curl --header "Content-Type: application/json" \
     --header "X-HTTP-Method: PUT" \
     --request POST \
    "http://hello-php.loc/?controller=ConcreteAPI"


# get
curl "http://simplon-tp-product-hunt.loc/?controller=ProductHuntAPI"

curl --request POST \
     "http://simplon-tp-product-hunt.loc/?controller=ProductHuntAPI"
     
# endpoint Product
curl "http://simplon-tp-product-hunt.loc/?controller=ProductHuntAPI&endpoint=Product"
curl "http://simplon-tp-product-hunt.loc/?controller=ProductHuntAPI&endpoint=Product&sub=Fresh"
curl "http://simplon-tp-product-hunt.loc/?controller=ProductHuntAPI&endpoint=Product&sub=Popular"
curl "http://simplon-tp-product-hunt.loc/?controller=ProductHuntAPI&endpoint=Product&product_id=2"
curl "http://simplon-tp-product-hunt.loc/?controller=ProductHuntAPI&endpoint=Product&product_id=5"
curl "http://simplon-tp-product-hunt.loc/?controller=ProductHuntAPI&endpoint=Product&sub=Popular&maxResults=3&startAt=2"
curl "http://simplon-tp-product-hunt.loc/?controller=ProductHuntAPI&endpoint=Product&sub=Fresh&maxResults=10&startAt=5"


# endpoint Vote
curl --request POST \
     "http://simplon-tp-product-hunt.loc/?controller=ProductHuntAPI&endpoint=Vote&product_id=2"

curl --request POST \
     "http://simplon-tp-product-hunt.loc/?controller=ProductHuntAPI&endpoint=Vote&user_id=2"

curl --request POST \
     "http://simplon-tp-product-hunt.loc/?controller=ProductHuntAPI&endpoint=Vote&user_id=2&product_id=1"

curl --request POST \
     "http://simplon-tp-product-hunt.loc/?controller=ProductHuntAPI&endpoint=Vote&user_id=1&product_id=8"


curl --request POST \
     "http://simplon-tp-product-hunt.loc/?controller=ProductHuntAPI&endpoint=Vote&user_id=1&product_id=9"

