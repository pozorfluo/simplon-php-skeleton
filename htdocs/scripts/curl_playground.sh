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


curl http://hello-php.loc/?controller=ConcreteAPI&action=Long
curl http://hello-php.loc/?controller=ConcreteAPI


curl --header "Content-Type: application/json" \
     --header "X-HTTP-Method: PUT" \
     --request POST \
    http://hello-php.loc/?controller=ConcreteAPI