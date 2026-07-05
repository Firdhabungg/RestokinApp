<?php

namespace Tests\Unit;

use App\Livewire\Dashboard\TransaksiChart;
use PHPUnit\Framework\TestCase;

class TransaksiChartDateExpressionTest extends TestCase
{
    public function test_it_returns_postgres_compatible_date_expression_for_yearly_period(): void
    {
        $component = new TransaksiChart();

        $this->assertSame(
            "to_char(tanggal, 'YYYY-MM')",
            $component->getDateGroupingExpression('pgsql', 'yearly')
        );
    }

    public function test_it_returns_sqlite_compatible_date_expression_for_daily_period(): void
    {
        $component = new TransaksiChart();

        $this->assertSame(
            "strftime('%Y-%m-%d', tanggal)",
            $component->getDateGroupingExpression('sqlite', 'daily')
        );
    }
}
