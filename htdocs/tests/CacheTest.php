<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class CacheTest extends TestCase
{
    public function test_a_Cache_instanced_with_an_existing_Cache_name_acquires_a_unique_name(): void
    {
        /* Given a Cache instance */
        $existing_cache = new \Helpers\Cache('ExistingCacheName');
        
        /* When a Cache with an existing Cache name is instanced */
        $cache = new \Helpers\Cache('ExistingCacheName');

        /* Then it acquires a unique name */
        $this->assertTrue($cache->name !== $existing_cache->name);
    }
}
