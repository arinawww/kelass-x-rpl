<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('kasir.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'paid' => 'required|numeric|min:0'
        ]);

        $total = 0;
        $validItems = [];

        // hitung total dan validasi stok
        foreach ($request->items as $item) {
            if (!isset($item['product_id']) || !isset($item['qty'])) continue;

            $product = Product::find($item['product_id']);
            if (!$product || $product->stock < $item['qty']) continue;

            $total += $product->price * $item['qty'];
            $validItems[] = [
                'product' => $product,
                'qty' => $item['qty']
            ];
        }

        if (count($validItems) == 0) {
            return redirect('/kasir')->with('error', 'Tidak ada produk valid untuk diproses.');
        }

        if ($request->paid < $total) {
            return redirect('/kasir')->with('error', 'Uang bayar tidak mencukupi.');
        }

        // simpan transaksi
        $transaction = Transaction::create([
            'total_price' => $total,
            'paid' => $request->paid,
            'change' => $request->paid - $total,
            'cashier_name' => \Illuminate\Support\Facades\Auth::user()->name,
        ]);

        // simpan detail + kurangi stok
        foreach ($validItems as $vItem) {
            $product = $vItem['product'];
            $qty = $vItem['qty'];

            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'qty' => $qty,
                'price' => $product->price
            ]);

            // kurangi stok
            $product->stock -= $qty;
            $product->save();
        }

        return redirect('/kasir')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function history(Request $request)
    {
        $query = Transaction::latest();

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->filled('cashier_name')) {
            $query->where('cashier_name', 'like', '%' . $request->cashier_name . '%');
        }

        $transactions = $query->get();
        return view('transactions.index', compact('transactions'));
    }
}