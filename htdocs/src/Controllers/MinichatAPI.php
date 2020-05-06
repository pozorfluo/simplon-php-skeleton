<?php

/**
 * 
 */

declare(strict_types=1);

namespace Controllers;

use Models\Model;

/*
api/2/componentExpand all methods
Create component
POST /rest/api/2/component
Update component
PUT /rest/api/2/component/{id}
Get component
GET /rest/api/2/component/{id}
Delete
DELETE /rest/api/2/component/{id}
Get component related issues
GET /rest/api/2/component/{id}/relatedIssueCounts
*/

/**
 * 
 */
class MinichatAPI extends API
{
    /**  
     *  Minichat
     */
    public function runDefault(array $args = []): void
    {
        
        /* set model, args, ...then call() */

        $this->set($args);
        $this->call();
        echo '<pre>'.var_export($this->args, true).'</pre><hr />';
    }
}

// INSERT INTO `users`(
//     `nickname`,
//     `created_at`,
//     `ip_address`,
//     `color`
// )

// VALUES('jzzz', NOW(), '1321.121.54.7', '#FF00FF');
// SELECT LAST_INSERT_ID();