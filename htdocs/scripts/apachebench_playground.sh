# create 100 connections with concurrency level of 10 simultaneous connections
ab -n 100 -c 10 http://hello-php.loc/
ab -n 100 -c 10 http://emjjjpl.cluster029.hosting.ovh.net/
ab -n 100 -c 10 http://emjjjpl.cluster029.hosting.ovh.net/?controller=MinichatAPI
ab -n 100 -c 10 http://emjjjpl.cluster029.hosting.ovh.net/?controller=MinichatAPI&action=Long

# output to file
ab -n 100 -c 10 -e bench.csv http://emjjjpl.cluster029.hosting.ovh.net/
