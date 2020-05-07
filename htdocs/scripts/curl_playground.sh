# mock a post
curl --header "Content-Type: application/json" \
    --request POST \
    --data '{"nickname" : "qdqdqz", "message":"hello qsdsqd curl" }' \
    http://hello-php.loc/?controller=MinichatAPI

# mock a post on live site
curl --header "Content-Type: application/json" \
    --request POST \
    --data '{"nickname" : "qdqdqz", "message":"hello qsdsqd curl" }' \
    http://emjjjpl.cluster029.hosting.ovh.net/?controller=MinichatAPI


curl http://hello-php.loc/?controller=MinichatAPI&action=Long
curl http://hello-php.loc/?controller=MinichatAPI