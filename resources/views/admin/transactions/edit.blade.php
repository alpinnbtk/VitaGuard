@extends('layouts.admin')
@section('title', 'Edit Konsultasi')

@section('content')
<div class="card-custom" style="max-width: 700px;">
    <div class="card-header">
        <h5><i class="bi bi-pencil-square me-2"></i>Edit Konsultasi</h5>
    </div>
    <div class="p-4">
        <form action="{{ route('admin.transactions.update', $transaction) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="user_id" class="form-label fw-medium">Member <span class="text-danger">*</span></label>
                    <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ old('user_id', $transaction->user_id) == $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="doctor_id" class="form-label fw-medium">Dokter <span class="text-danger">*</span></label>
                    <select name="doctor_id" id="doctor_id" class="form-select @error('doctor_id') is-invalid @enderror" required>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('doctor_id', $transaction->doctor_id) == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }} — {{ $doctor->specialization }}</option>
                        @endforeach
                    </select>
                    @error('doctor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="consultation_date" class="form-label fw-medium">Tanggal Konsultasi <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="consultation_date" id="consultation_date" class="form-control @error('consultation_date') is-invalid @enderror" value="{{ old('consultation_date', $transaction->consultation_date->format('Y-m-d\TH:i')) }}" required>
                    @error('consultation_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="total_price" class="form-label fw-medium">Total Harga (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="total_price" id="total_price" class="form-control @error('total_price') is-invalid @enderror" value="{{ old('total_price', $transaction->total_price) }}" step="1000" min="0" required>
                    @error('total_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label fw-medium">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="pending" {{ old('status', $transaction->status) == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="confirmed" {{ old('status', $transaction->status) == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="completed" {{ old('status', $transaction->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ old('status', $transaction->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12">
                    <label for="notes" class="form-label fw-medium">Catatan</label>
                    <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $transaction->notes) }}</textarea>
                    @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Perbarui</button>
                <a href="{{ route('admin.transactions.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
