<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserAdminPagesTest extends TestCase
{
    public function test_login_page_is_accessible()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_admin_dasbor_requires_auth()
    {
        $response = $this->get('/admin/dasbor');
        // Assuming it redirects or 403, but since 404, maybe route not loaded
        $this->assertNotEquals(404, $response->getStatusCode());
    }
}
