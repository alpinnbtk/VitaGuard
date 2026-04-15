<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'doctor'])->latest()->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $members = User::where('role', 'member')->get();
        $doctors = Doctor::all();
        return view('admin.transactions.create', compact('members', 'doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:doctors,id',
            'consultation_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'total_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        Transaction::create($request->only([
            'user_id', 'doctor_id', 'consultation_date',
            'status', 'total_price', 'notes'
        ]));

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'doctor']);
        return view('admin.transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $members = User::where('role', 'member')->get();
        $doctors = Doctor::all();
        return view('admin.transactions.edit', compact('transaction', 'members', 'doctors'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:doctors,id',
            'consultation_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'total_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $transaction->update($request->only([
            'user_id', 'doctor_id', 'consultation_date',
            'status', 'total_price', 'notes'
        ]));

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }
}
