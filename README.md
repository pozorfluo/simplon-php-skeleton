# simplony

__*WIP*__ !
A student-developped php educational mini-framework based on the MVC pattern.

### [live example website](http://emjjjpl.cluster029.hosting.ovh.net/)

## installation

1. Clone this repository

   ```shell
   git clone --depth=1 **todo**
   ```

1. Setup the database with :

   ```
   htdocs/resources/sql/example.sql
   ```

   If this fails for your setup, use the following for improved compatibility :

   ```
   htdocs/resources/sql/example_bootstrap.sql
   ```

   _( note : this will bootstrap the database with test data )_

1. In index.php, change DEV_FORCE_CONFIG_UPDATE to true
   ```php
   define('DEV_FORCE_CONFIG_UPDATE', true);
   ```
1. Navigate to index.php in your environment
   - A .env file is created with a skeleton config for this app.
   - Update the default db configuration in .env to match your environment.
     e.g.,
   ```json
     "db_configs": {
       "product_hunt": {
       "DB_DRIVER": "mysql",
       "DB_HOST": "127.0.0.1",
       "DB_PORT": "3306",
       "DB_CHARSET": "utf8mb4",
       "DB_NAME": "tp_product_hunt",
       "DB_USER": "your_user_name",
       "DB_PASSWORD": "your_db_password"
       }
   ```
1. Navigate to index.php

## docs

## notes

### convention-based routing/dispatching
*It seems that this fine specimen of buzzwordy banter is already in use for 
something different.*

Controller's method following a naming scheme based on reserved
prefixes are automatically considered viable routes by the Dispatcher.

( After some research, it seems similar to the default routing system in ASP.NET
modulo the use of reserved prefixes )


### caching strategy
> cache-as-sor, refresh-ahead, tag-based invalidation queue 
~~populated by triggers in db~~.

see [oracle docs](https://docs.oracle.com/cd/E15357_01/coh.360/e15723/cache_rtwtwbra.htm#COHDG208)

#### refresh-ahead

#### invalidation
Consider that __*invalidation*__ may need to be __triggered from many places__ :
- components of the app itself
- interaction with RESTish API
- direct writes to the db

Components of the app including its RESTish API may directly call/queue 
invalidation from the Cache API.

Direct writes to the db will invoke triggers populating a table with 
invalidation requests.

That invalidation requests table will be routinely collected and executed by
a cache managing component of the app as part of a clean-up phase after a 
request is served.

Consider the duplication problem if both channels are allowed and db writes
invoke triggers indiscriminately.


Consider that it may be needed to __*invalidate*__ a __single item__ or a 
__bunch of related items__.
- key-based invalidation
- tag-based invalidation

#### structure
Back the cache trove with a __hash table__.

- cache item key
  + Use the request and account for session/cookie.
  + Consider that some things should not/need not get cached.
- cache item value


#### time-to-live
Consider that different time-to-live may make sense for different kinds of 
cached items.

#### stochastic early expiration
Spread out cache items expirations by randomly shortening cache-items 
time-to-live factoring in their popularity and render time cost.

#### eviction
Piggyback on the popularity counter used for the refresh-ahead policy. When the
cache reaches capacity, replace __Least Frequently Used__ cache item. 
*Break ties* going for __Least Recently Requested__ cache item, then 
pick __randomly__.

#### cache lock
Lock cache items being refreshed and extend their time-to-live during the lock.
There __must not be multiple concurrent attempts to refresh an item__. 
Any subsequent request for a locked item will be served a *stale* cache item.

#### debug infos
Add a *generated at :* __timestamp__ to cached items content.

## todo

- [x] Merge updates from simplon-tp-product-hunt exercise.
- [ ] Document with phpdoc as done in simplon-tp-product-hunt exercise.
- [ ] Work/Test with phpunit as done with Cache class.
  + [ ] See https://stackoverflow.com/questions/31217935/how-to-unit-test-a-database-insert-function-pdo
- [ ] Consider splitting core and app files.
- [ ] Update repo name.  
- [x] ~~Consider registering routes explicitely in index.php.~~
- [ ] Extend the convention based auto-routing system.
  + [ ] Implement alternate *cute* path scheme.
  + [ ] Add a way to retrieve/display the whole routing scheme.
- [ ] Implement some form of Authentification, Authorization (+ Accountability) 
      in RESTish API.
- [ ] Add Http caching directives to RESTish API.

## decisions log

- Follow PSR-1 and PSR-12 coding standards.

## reference links
