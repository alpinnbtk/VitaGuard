@extends('layouts.admin')
@section('title', 'Edit Konsultasi')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-light" style="border-radius:8px;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h5 class="fw-semibold mb-0" style="color:#0f172a;">Edit Konsultasi</h5>
        <p class="text-muted mb-0" style="font-size:0.8rem;">Perbarui data pemesanan konsultasi pasien.</p>
    </div>
</div>

<div class="card-custom p-4">
    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" id="adminBookingForm">
        @csrf
        @method('PUT')

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label for="user_id" class="form-label fw-semibold" style="font-size:0.875rem;">Member <span class="text-danger">*</span></label>
                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" style="border-radius:8px;" required>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ old('user_id', $booking->user_id) == $member->id ? 'selected' : '' }}>
                            {{ $member->name }} ({{ $member->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label for="doctor_id" class="form-label fw-semibold" style="font-size:0.875rem;">Dokter <span class="text-danger">*</span></label>
                <select name="doctor_id" id="doctor_id" class="form-select @error('doctor_id') is-invalid @enderror" style="border-radius:8px;" onchange="onDoctorChanged(this)" required>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" data-schedule-url="{{ route('admin.doctors.schedules', $doctor->id) }}" {{ old('doctor_id', $booking->doctor_id) == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->name }} ({{ $doctor->specialization }})
                        </option>
                    @endforeach
                </select>
                @error('doctor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label for="doctor_schedule_id" class="form-label fw-semibold" style="font-size:0.875rem;">Jadwal Dokter <span class="text-danger">*</span></label>
                <select name="doctor_schedule_id" id="doctor_schedule_id" class="form-select @error('doctor_schedule_id') is-invalid @enderror" style="border-radius:8px;" onchange="onScheduleChanged(this)" required>
                    <option value="">-- Pilih Jadwal --</option>
                </select>
                @error('doctor_schedule_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <small id="schedules-loading" class="text-primary d-none"><i class="spinner-border spinner-border-sm me-1"></i>Memuat jadwal...</small>
            </div>

            <div class="col-md-6">
                <label for="booking_date" class="form-label fw-semibold" style="font-size:0.875rem;">Tanggal Konsultasi <span class="text-danger">*</span></label>
                <input type="date" name="booking_date" id="booking_date" class="form-control @error('booking_date') is-invalid @enderror" style="border-radius:8px;" min="{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') }}" value="{{ old('booking_date', \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d')) }}" required>
                @error('booking_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <small id="date-hint" class="text-muted d-block mt-1" style="font-size:0.78rem;"></small>
            </div>

            <div class="col-md-6">
                <label for="status" class="form-label fw-semibold" style="font-size:0.875rem;">Status Konsultasi <span class="text-danger">*</span></label>
                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" style="border-radius:8px;" required>
                    <option value="pending" {{ old('status', $booking->status) === 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                    <option value="confirmed" {{ old('status', $booking->status) === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="completed" {{ old('status', $booking->status) === 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ old('status', $booking->status) === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
                <label for="complaint" class="form-label fw-semibold" style="font-size:0.875rem;">Keluhan</label>
                <textarea name="complaint" id="complaint" rows="4" class="form-control @error('complaint') is-invalid @enderror" style="border-radius:8px;" placeholder="Tuliskan keluhan pasien di sini...">{{ old('complaint', $booking->complaint) }}</textarea>
                @error('complaint') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-light" style="border-radius:8px;">Batal</a>
            <button type="submit" class="btn btn-primary" style="border-radius:8px;">
                <i class="bi bi-floppy-fill me-1"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const DAY_LABELS = {
        'Senin': 'Monday', 'Selasa': 'Tuesday', 'Rabu': 'Wednesday',
        'Kamis': 'Thursday', 'Jumat': 'Friday', 'Sabtu': 'Saturday', 'Minggu': 'Sunday'
    };
    const DAY_JS = { 'Senin': 1, 'Selasa': 2, 'Rabu': 3, 'Kamis': 4, 'Jumat': 5, 'Sabtu': 6, 'Minggu': 0 };

    const CURRENT_SCHEDULE_ID = {{ $booking->doctor_schedule_id ?? 'null' }};
    let selectedScheduleDay = '';

    function onDoctorChanged(select, initial = false) {
        const option = select.options[select.selectedIndex];
        const scheduleUrl = option.dataset.scheduleUrl;
        const scheduleSelect = document.getElementById('doctor_schedule_id');
        const loading = document.getElementById('schedules-loading');

        scheduleSelect.innerHTML = '<option value="">-- Pilih Jadwal --</option>';
        scheduleSelect.disabled = true;
        selectedScheduleDay = '';
        document.getElementById('date-hint').textContent = '';

        if (!select.value) return;

        loading.classList.remove('d-none');

        fetch(scheduleUrl, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(r => r.json())
        .then(schedules => {
            loading.classList.add('d-none');
            if (schedules.length > 0) {
                scheduleSelect.disabled = false;
                schedules.forEach(s => {
                    const start = s.start_time.substring(0, 5);
                    const end = s.end_time.substring(0, 5);
                    const opt = document.createElement('option');
                    opt.value = s.id;
                    opt.dataset.day = s.day;
                    opt.textContent = `${s.day} (${start} - ${end})`;

                    if (initial && s.id === CURRENT_SCHEDULE_ID) {
                        opt.selected = true;
                        selectedScheduleDay = s.day;
                    }

                    scheduleSelect.appendChild(opt);
                });

                if (initial && selectedScheduleDay) {
                    const dayName = DAY_LABELS[selectedScheduleDay] ?? selectedScheduleDay;
                    document.getElementById('date-hint').textContent = `Catatan: Pastikan memilih tanggal yang jatuh pada hari ${selectedScheduleDay} (${dayName}).`;
                }
            } else {
                scheduleSelect.innerHTML = '<option value="">Dokter tidak memiliki jadwal tersedia</option>';
            }
        })
        .catch(() => {
            loading.classList.add('d-none');
        });
    }

    function onScheduleChanged(select) {
        const option = select.options[select.selectedIndex];
        if (select.value && option.dataset.day) {
            selectedScheduleDay = option.dataset.day;
            const dayName = DAY_LABELS[selectedScheduleDay] ?? selectedScheduleDay;
            document.getElementById('date-hint').textContent = `Catatan: Pastikan memilih tanggal yang jatuh pada hari ${selectedScheduleDay} (${dayName}).`;
        } else {
            selectedScheduleDay = '';
            document.getElementById('date-hint').textContent = '';
        }
    }

    document.getElementById('adminBookingForm').addEventListener('submit', function (e) {
        const dateVal = document.getElementById('booking_date').value;
        const scheduleSelect = document.getElementById('doctor_schedule_id');
        const option = scheduleSelect.options[scheduleSelect.selectedIndex];

        if (dateVal && option && option.dataset.day) {
            const jsDay = DAY_JS[option.dataset.day];
            const pickedDay = new Date(dateVal + 'T00:00:00').getDay();
            if (pickedDay !== jsDay) {
                e.preventDefault();
                alert(`Jadwal yang dipilih adalah hari ${option.dataset.day}. Silakan pilih tanggal yang jatuh pada hari ${option.dataset.day}.`);
            }
        }
    });

    window.addEventListener('DOMContentLoaded', () => {
        onDoctorChanged(document.getElementById('doctor_id'), true);
    });
</script>
@endpush
@endsection
