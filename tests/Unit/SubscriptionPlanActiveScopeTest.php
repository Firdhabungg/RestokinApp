<?php

namespace Tests\Unit;

use App\Models\SubscriptionPlan;
use Tests\TestCase;

class SubscriptionPlanActiveScopeTest extends TestCase
{
    public function test_active_scope_uses_boolean_filter_only(): void
    {
        $query = SubscriptionPlan::query()->active();

        $this->assertSame(true, $query->getQuery()->wheres[0]['value']);
        $this->assertSame('=', $query->getQuery()->wheres[0]['operator']);
    }
}
