@extends('layouts.member')
@section('title', 'Buat Booking Konsultasi')

@section('content')
<div class="container mt-5 mb-5">
    <div class="mb-4">
        <h2 style="font-family: 'Sora', sans-serif; color: var(--dark); font-weight: 700;">Buat Booking Konsultasi</h2>
        <hr style="width: 50px; height: 3px; background-color: var(--dark); opacity: 1; border: none;">
    </div>

    <div class="card shadow" style="border-radius: 15px; overflow: hidden; border: none;">
        <div class="row g-0">

            {{-- LEFT: Step Navigator --}}
            <div class="col-md-4 p-4 text-white" style="background-color: var(--dark);">
                <h5 class="mb-4" style="font-weight: 600;">Tahapan Booking</h5>

                <div class="step-indicator active-step mb-3" id="nav-step-1">
                    <div class="d-flex align-items-center">
                        <div class="step-circle me-3">1</div>
                        <div>
                            <h6 class="mb-0">Pilih Dokter</h6>
                            <small class="text-white-50" id="summary-doctor">Belum dipilih</small>
                        </div>
                    </div>
                </div>

                <div class="step-indicator mb-3" id="nav-step-2">
                    <div class="d-flex align-items-center">
                        <div class="step-circle me-3">2</div>
                        <div>
                            <h6 class="mb-0">Pilih Jadwal</h6>
                            <small class="text-white-50" id="summary-schedule">Belum dipilih</small>
                        </div>
                    </div>
                </div>

                <div class="step-indicator" id="nav-step-3">
                    <div class="d-flex align-items-center">
                        <div class="step-circle me-3">3</div>
                        <div>
                            <h6 class="mb-0">Konfirmasi</h6>
                            <small class="text-white-50">Review detail</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Form Steps --}}
            <div class="col-md-8 p-5 bg-white">
                <form action="{{ route('member.booking.store') }}" method="POST" id="bookingForm">
                    @csrf

                    {{-- STEP 1: Choose Doctor --}}
                    <div id="step-1" class="form-step">
                        <h4 class="mb-4" style="color: var(--dark); font-weight: 600;">Pilih Dokter</h4>

                        <input type="text" id="doctorSearch" class="form-control mb-3"
                               placeholder="Cari nama atau spesialisasi dokter..."
                               onkeyup="filterDoctors()"
                               style="border-radius: 10px;">

                        <div class="list-group" style="max-height: 400px; overflow-y: auto;">
                            @foreach($doctors as $doctor)
                            <label class="list-group-item p-3 doctor-option"
                                   data-doctor-id="{{ $doctor->id }}"
                                   data-doctor-name="{{ $doctor->name }}"
                                   data-schedule-url="{{ route('member.doctors.schedules', $doctor->id) }}"
                                   style="display: flex; cursor: pointer; border-radius: 10px; margin-bottom: 10px; border: 1px solid #e0e0e0; align-items: center;">
                                <input class="form-check-input me-3" type="radio" name="doctor_id"
                                       value="{{ $doctor->id }}"
                                       onchange="onDoctorSelected(this)"
                                       required>
                                <img src="{{ $doctor->image ? asset('storage/' . $doctor->image) : asset('images/doctors/default-article.jpg') }}"
                                     class="rounded-circle me-3"
                                     style="width: 50px; height: 50px; object-fit: cover; border: 1px solid #ddd;">
                                <div>
                                    <h6 class="mb-0" style="color: var(--dark); font-weight: 600;">{{ $doctor->name }}</h6>
                                    <small style="color: var(--accent); font-weight: 500;">{{ $doctor->specialization }}</small>
                                    <br><small class="text-muted">{{ $doctor->experience_years }} tahun pengalaman</small>
                                </div>
                            </label>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn text-white px-4"
                                    style="background-color: var(--accent); border-radius: 20px;"
                                    onclick="nextStep(2)">
                                Selanjutnya <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    {{-- STEP 2: Choose Schedule --}}
                    <div id="step-2" class="form-step d-none">
                        <h4 class="mb-4" style="color: var(--dark); font-weight: 600;">Pilih Jadwal Konsultasi</h4>

                        {{-- Hidden inputs that will be filled by JS --}}
                        <input type="hidden" name="doctor_schedule_id" id="selected_schedule_id">

                        {{-- Loading indicator --}}
                        <div id="schedules-loading" class="text-center py-4 d-none">
                            <div class="spinner-border text-primary" style="width:2rem; height:2rem;"></div>
                            <p class="text-muted mt-2 mb-0" style="font-size:0.85rem;">Memuat jadwal...</p>
                        </div>

                        {{-- No schedules state --}}
                        <div id="schedules-empty" class="text-center py-4 d-none">
                            <i class="bi bi-calendar-x" style="font-size:2.5rem; color:#cbd5e1;"></i>
                            <p class="text-muted mt-2 mb-0" style="font-size:0.85rem;">Dokter ini belum memiliki jadwal yang tersedia.</p>
                        </div>

                        {{-- Schedule list container --}}
                        <div id="schedules-container" class="mb-4"></div>

                        {{-- Date picker --}}
                        <div class="mb-4" id="date-section" style="display:none;">
                            <label class="form-label fw-semibold" style="font-size:0.9rem;">Pilih Tanggal Kunjungan</label>
                            <input type="date" name="booking_date" id="booking_date" class="form-control"
                                   style="border-radius: 10px;"
                                   min="{{ date('Y-m-d') }}"
                                   onchange="updateConfirmSummary()"
                                   required>
                            <small class="text-muted" id="date-hint" style="font-size:0.78rem;"></small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light px-4" style="border-radius: 20px;" onclick="prevStep(1)">Kembali</button>
                            <button type="button" class="btn text-white px-4"
                                    style="background-color: var(--accent); border-radius: 20px;"
                                    onclick="nextStep(3)">Selanjutnya</button>
                        </div>
                    </div>

                    {{-- STEP 3: Confirmation --}}
                    <div id="step-3" class="form-step d-none">
                        <h4 class="mb-4" style="color: var(--dark); font-weight: 600;">Konfirmasi Booking</h4>

                        <div class="p-3 mb-4" style="background-color: #f3faf9; border-radius: 10px; border-left: 4px solid var(--accent);">
                            <p class="mb-1"><strong>Layanan:</strong> Konsultasi Online</p>
                            <p class="mb-1"><strong>Dokter:</strong> <span id="confirm-doctor">—</span></p>
                            <p class="mb-1"><strong>Jadwal:</strong> <span id="confirm-schedule">—</span></p>
                            <p class="mb-0"><strong>Tanggal:</strong> <span id="confirm-date">—</span></p>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="font-size:0.9rem;">Keluhan Singkat (Opsional)</label>
                            <textarea name="complaint" class="form-control" rows="3"
                                      placeholder="Ceritakan keluhan Anda agar dokter dapat mempersiapkan diri..."
                                      style="border-radius: 10px; font-size:0.875rem;"></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light px-4" style="border-radius: 20px;" onclick="prevStep(2)">Kembali</button>
                            <button type="submit" class="btn text-white px-4" style="background-color: var(--dark); border-radius: 20px;">
                                <i class="bi bi-check-circle-fill me-1"></i>Konfirmasi & Booking
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .step-indicator { opacity: 0.5; transition: 0.3s; }
    .step-indicator.active-step { opacity: 1; border-left: 4px solid var(--accent); padding-left: 10px; }
    .step-circle {
        width: 30px; height: 30px; border-radius: 50%;
        border: 2px solid #fff; display: flex;
        align-items: center; justify-content: center; font-weight: bold;
    }
    .active-step .step-circle { background-color: var(--accent); border-color: var(--accent); color: #fff; }

    .list-group-item:hover { background-color: #f8f9fa; }
    .list-group-item:has(input:checked) { border-color: var(--accent) !important; background-color: #f3faf9; }

    .schedule-option {
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 16px;
        cursor: pointer;
        transition: all 0.15s;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 10px;
    }
    .schedule-option:has(input:checked) {
        border-color: var(--accent) !important;
        background-color: #f3faf9;
    }
    .schedule-option:hover { border-color: var(--accent); }
</style>

@push('scripts')
<script>
    const DAY_LABELS = {
        'Senin': 'Monday', 'Selasa': 'Tuesday', 'Rabu': 'Wednesday',
        'Kamis': 'Thursday', 'Jumat': 'Friday', 'Sabtu': 'Saturday', 'Minggu': 'Sunday'
    };
    const DAY_JS = { 'Senin':1,'Selasa':2,'Rabu':3,'Kamis':4,'Jumat':5,'Sabtu':6,'Minggu':0 };

    let selectedDoctorName     = '';
    let selectedScheduleLabel  = '';
    let selectedScheduleDay    = '';

    // ── When a doctor radio is selected ──────────────────────────────
    function onDoctorSelected(radio) {
        const label      = radio.closest('.doctor-option');
        selectedDoctorName = label.dataset.doctorName;
        const url        = label.dataset.scheduleUrl;

        document.getElementById('summary-doctor').textContent  = selectedDoctorName;
        document.getElementById('confirm-doctor').textContent  = selectedDoctorName;

        // Reset schedule state
        document.getElementById('selected_schedule_id').value = '';
        document.getElementById('schedules-container').innerHTML = '';
        document.getElementById('date-section').style.display = 'none';
        document.getElementById('schedules-empty').classList.add('d-none');
        document.getElementById('schedules-loading').classList.remove('d-none');

        // Fetch schedules via AJAX
        fetch(url, { headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } })
            .then(r => r.json())
            .then(schedules => {
                document.getElementById('schedules-loading').classList.add('d-none');
                const container = document.getElementById('schedules-container');

                if (!schedules.length) {
                    document.getElementById('schedules-empty').classList.remove('d-none');
                    return;
                }

                schedules.forEach(s => {
                    const start = s.start_time.substring(0, 5);
                    const end   = s.end_time.substring(0, 5);
                    const html  = `
                        <label class="schedule-option">
                            <input type="radio" name="_schedule_radio" value="${s.id}"
                                   data-day="${s.day}" data-label="${s.day}, ${start}–${end}"
                                   onchange="onScheduleSelected(this)">
                            <div>
                                <div class="fw-semibold" style="color:var(--dark); font-size:0.9rem;">${s.day}</div>
                                <small class="text-muted"><i class="bi bi-clock me-1"></i>${start} – ${end}</small>
                            </div>
                        </label>`;
                    container.insertAdjacentHTML('beforeend', html);
                });
            })
            .catch(() => {
                document.getElementById('schedules-loading').classList.add('d-none');
                document.getElementById('schedules-empty').classList.remove('d-none');
            });
    }

    // ── When a schedule slot is selected ──────────────────────────────
    function onScheduleSelected(radio) {
        document.getElementById('selected_schedule_id').value = radio.value;
        selectedScheduleLabel = radio.dataset.label;
        selectedScheduleDay   = radio.dataset.day;

        // Show date picker and guide user to matching day
        document.getElementById('date-section').style.display = 'block';
        document.getElementById('confirm-schedule').textContent = selectedScheduleLabel;
        document.getElementById('summary-schedule').textContent = selectedScheduleLabel;

        // Set a helpful hint for the date
        const dayName = DAY_LABELS[selectedScheduleDay] ?? selectedScheduleDay;
        document.getElementById('date-hint').textContent = `Pilih tanggal yang jatuh pada hari ${selectedScheduleDay} (${dayName}).`;
    }

    // ── Update confirmation date display ──────────────────────────────
    function updateConfirmSummary() {
        const dateVal = document.getElementById('booking_date').value;
        if (!dateVal) return;
        const d = new Date(dateVal + 'T00:00:00');
        document.getElementById('confirm-date').textContent =
            d.toLocaleDateString('id-ID', { weekday:'long', day:'numeric', month:'long', year:'numeric' });
    }

    // ── Step navigation ───────────────────────────────────────────────
    function validateStep(step) {
        if (step === 1) {
            if (!document.querySelector('input[name="doctor_id"]:checked')) {
                alert('Tolong pilih dokter terlebih dahulu.');
                return false;
            }
        }
        if (step === 2) {
            if (!document.getElementById('selected_schedule_id').value) {
                alert('Tolong pilih jadwal konsultasi.');
                return false;
            }
            if (!document.getElementById('booking_date').value) {
                alert('Tolong pilih tanggal kunjungan.');
                return false;
            }
            // Validate the selected date matches the chosen schedule day
            const dateVal    = document.getElementById('booking_date').value;
            const selectedDay = document.querySelector('input[name="_schedule_radio"]:checked')?.dataset.day;
            if (selectedDay) {
                const jsDay = DAY_JS[selectedDay];
                const pickedDay = new Date(dateVal + 'T00:00:00').getDay();
                if (pickedDay !== jsDay) {
                    alert(`Jadwal yang dipilih adalah hari ${selectedDay}. Tolong pilih tanggal yang jatuh pada hari ${selectedDay}.`);
                    return false;
                }
            }
        }
        return true;
    }

    function nextStep(n) {
        if (!validateStep(n - 1)) return;
        document.querySelectorAll('.form-step').forEach(el => el.classList.add('d-none'));
        document.getElementById('step-' + n).classList.remove('d-none');
        updateNav(n);
    }

    function prevStep(n) {
        document.querySelectorAll('.form-step').forEach(el => el.classList.add('d-none'));
        document.getElementById('step-' + n).classList.remove('d-none');
        updateNav(n);
    }

    function updateNav(n) {
        document.querySelectorAll('.step-indicator').forEach(el => el.classList.remove('active-step'));
        for (let i = 1; i <= n; i++) {
            document.getElementById('nav-step-' + i).classList.add('active-step');
        }
    }

    // ── Doctor search filter ──────────────────────────────────────────
    function filterDoctors() {
        const search = document.getElementById('doctorSearch').value.toLowerCase();
        document.querySelectorAll('.doctor-option').forEach(opt => {
            opt.style.setProperty('display', opt.innerText.toLowerCase().includes(search) ? 'flex' : 'none', 'important');
        });
    }
</script>
@endpush
@endsection
