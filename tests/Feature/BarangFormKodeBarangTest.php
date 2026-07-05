<?php

namespace Tests\Feature;

use App\Livewire\BarangForm;
use Tests\TestCase;

class BarangFormKodeBarangTest extends TestCase
{
    public function test_it_generates_next_kode_barang_without_mysql_specific_syntax(): void
    {
        $component = new BarangForm();

        $reflection = new \ReflectionClass($component);
        $method = $reflection->getMethod('buildKodeBarang');
        $method->setAccessible(true);

        $result = $method->invoke($component, ['BRG-00001', 'BRG-00003']);

        $this->assertSame('BRG-00004', $result);
    }
}
