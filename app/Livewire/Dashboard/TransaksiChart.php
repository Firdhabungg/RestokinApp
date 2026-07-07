<?php

namespace App\Livewire\Dashboard;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TransaksiChart extends Component
{
    public string $period = 'monthly';

    public function setPeriod(string $value): void
    {
        $this->period = $value;
        $this->dispatch('transaksiChartUpdated', data: $this->getChartData());
    }

    public function getChartData(): array
    {
        $tokoId = Auth::user()->effective_toko_id;
        $driver = DB::getDriverName();

        if ($this->period === 'yearly') {
            $dateExpression = $this->getDateGroupingExpression($driver, 'yearly');
            $sales = Sale::where('toko_id', $tokoId)
                ->completed()
                ->byPeriod($this->period)
                ->selectRaw($dateExpression . " as date, COUNT(*) as total_transaksi, SUM(total) as total_penjualan")
                ->groupBy('date')
                ->orderBy('date')
                ->get();
        } else {
            $dateExpression = $this->getDateGroupingExpression($driver, 'daily');
            $sales = Sale::where('toko_id', $tokoId)
                ->completed()
                ->byPeriod($this->period)
                ->selectRaw($dateExpression . " as date, COUNT(*) as total_transaksi, SUM(total) as total_penjualan")
                ->groupBy('date')
                ->orderBy('date')
                ->get();
        }

        // ④ Selaraskan data DB dengan label sumbu-X yang lengkap
        $labels = $this->generateLabels();
        $transaksiData = [];
        $penjualanData = [];

        foreach ($labels as $label => $date) {
            $found = $sales->firstWhere('date', $date);
            $transaksiData[] = $found ? (int) $found->total_transaksi : 0;
            $penjualanData[] = $found ? (float) $found->total_penjualan : 0;
        }

        return [
            'labels'    => array_keys($labels), // label tampilan sumbu-X
            'transaksi' => $transaksiData,
            'penjualan' => $penjualanData,
        ];
    }

    public function getDateGroupingExpression(string $driver, string $period): string
    {
        if ($period === 'yearly') {
            return match ($driver) {
                'pgsql', 'postgres' => "to_char(tanggal, 'YYYY-MM')",
                'sqlite' => "strftime('%Y-%m', tanggal)",
                default => "DATE_FORMAT(tanggal, '%Y-%m')",
            };
        }

        return match ($driver) {
            'pgsql', 'postgres' => "to_char(tanggal, 'YYYY-MM-DD')",
            'sqlite' => "strftime('%Y-%m-%d', tanggal)",
            default => "DATE(tanggal)",
        };
    }

    // ⑤ Generate label sumbu-X sesuai periode
    private function generateLabels(): array
    {
        $labels = [];

        match ($this->period) {
            // 7 hari (Senin–Minggu minggu ini)
            'weekly' => (function () use (&$labels) {
                $start = now()->startOfWeek();
                for ($i = 0; $i < 7; $i++) {
                    $date = $start->copy()->addDays($i);
                    $labels[$date->isoFormat('ddd, D MMM')] = $date->format('Y-m-d');
                }
            })(),

            // Semua hari dalam bulan ini (1–28/29/30/31)
            'monthly' => (function () use (&$labels) {
                $daysInMonth = now()->daysInMonth;
                for ($i = 1; $i <= $daysInMonth; $i++) {
                    $date = now()->copy()->setDay($i);
                    $labels[$date->format('d')] = $date->format('Y-m-d');
                }
            })(),

            // 12 bulan dalam tahun ini (Jan–Des)
            'yearly' => (function () use (&$labels) {
                for ($m = 1; $m <= 12; $m++) {
                    $date = Carbon::create(now()->year, $m, 1);
                    $labels[$date->isoFormat('MMM')] = $date->format('Y-m');
                }
            })(),
        };

        return $labels;
    }

    public function render()
    {
        return view('livewire.dashboard.transaksi-chart', [
            'chartData' => $this->getChartData(),
        ]);
    }
}
