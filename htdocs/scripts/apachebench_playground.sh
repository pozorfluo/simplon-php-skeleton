# create 100 connections with concurrency level of 10 simultaneous connections
ab -n 100 -c 10 http://hello-php.loc/
ab -n 100 -c 10 http://emjjjpl.cluster029.hosting.ovh.net/

# output to file
ab -n 100 -c 10 -e bench.csv http://emjjjpl.cluster029.hosting.ovh.net/
