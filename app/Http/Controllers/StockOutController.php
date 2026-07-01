<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StockOut;
use App\Models\StockBatch;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockOutController extends Controller
{
    protected StockService $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function index()
    {
        return view('stock.out.index');
    }



    public function show(StockOut $stockOut)
    {
        $stockOut->load(['barang', 'batch', 'user']);

        return view('stock.out.show', compact('stockOut'));
    }
}
