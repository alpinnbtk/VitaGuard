@extends('layouts.member')

@section('content')
<div class="container mt-5 mb-5">
    <div class="mb-4">
        <h2 style="font-family: 'Sora', sans-serif; color: var(--dark); font-weight: 700;">Buat Booking Konsultasi</h2>
        <hr style="width: 50px; height: 3px; background-color: var(--dark); opacity: 1; border: none;">
    </div>

    <div class="card shadow" style="border-radius: 15px; overflow: hidden; border: none;">
        <div class="row g-0">
            
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
                            <h6 class="mb-0">Tanggal & Waktu</h6>
                            <small class="text-white-50" id="summary-time">Belum dipilih</small>
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

            <div class="col-md-8 p-5 bg-white">
                <form action="{{ route('member.booking.store') }}" method="POST" id="bookingForm">
                    @csrf
                    
                    <div id="step-1" class="form-step">
                        <h4 class="mb-4" style="color: var(--dark); font-weight: 600;">Pilih Layanan & Dokter</h4>

                        <div class="mb-4">
                            <label class="form-label" style="font-weight: 500;">Pilih Dokter</label>
                            
                            <input type="text" id="doctorSearch" class="form-control mb-3" placeholder="Cari nama atau spesialisasi dokter..." onkeyup="filterDoctors()" style="border-radius: 10px;">
                            
                            <div class="list-group" style="max-height: 400px; overflow-y: auto;">
                                @foreach($doctors as $doctor)
                                <label class="list-group-item p-3 doctor-option" style="display: flex; cursor: pointer; border-radius: 10px; margin-bottom: 10px; border: 1px solid #e0e0e0; align-items: center;">
                                    <input class="form-check-input me-3" type="radio" name="doctor_id" value="{{ $doctor->id }}" onchange="updateSummary()" required>
                                    <img src="{{ $doctor->image ?? asset('images/doctors/default-article.jpg') }}" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover; border: 1px solid #ddd;">
                                    <div>
                                        <h6 class="mb-0" style="color: var(--dark); font-weight: 600;">{{ $doctor->name }}</h6>
                                        <small style="color: var(--accent); font-weight: 500;">{{ $doctor->specialization }}</small>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn text-white px-4" style="background-color: var(--accent); border-radius: 20px;" onclick="nextStep(2)">Selanjutnya <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>

                    <div id="step-2" class="form-step d-none">
                        <h4 class="mb-4" style="color: var(--dark); font-weight: 600;">Pilih Jadwal Konsultasi</h4>
                        
                        <div class="mb-4">
                            <label class="form-label" style="font-weight: 500;">Pilih Tanggal</label>
                            <input type="date" name="booking_date" id="booking_date" class="form-control" style="border-radius: 10px;" onchange="updateSummary()" required min="{{ date('Y-m-d') }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label" style="font-weight: 500;">Pilih Waktu Tersedia</label>
                            <div class="d-flex flex-wrap gap-2">
                                <input type="radio" class="btn-check" name="booking_time" id="time1" value="09:00" onchange="updateSummary()" required>
                                <label class="btn btn-outline-primary time-pill" for="time1">09:00</label>

                                <input type="radio" class="btn-check" name="booking_time" id="time2" value="10:30" onchange="updateSummary()">
                                <label class="btn btn-outline-primary time-pill" for="time2">10:30</label>

                                <input type="radio" class="btn-check" name="booking_time" id="time3" value="13:00" onchange="updateSummary()">
                                <label class="btn btn-outline-primary time-pill" for="time3">13:00</label>
                                
                                <input type="radio" class="btn-check" name="booking_time" id="time4" value="15:30" onchange="updateSummary()">
                                <label class="btn btn-outline-primary time-pill" for="time4">15:30</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light px-4" style="border-radius: 20px;" onclick="prevStep(1)">Kembali</button>
                            <button type="button" class="btn text-white px-4" style="background-color: var(--accent); border-radius: 20px;" onclick="nextStep(3)">Selanjutnya</button>
                        </div>
                    </div>

                    <div id="step-3" class="form-step d-none">
                        <h4 class="mb-4" style="color: var(--dark); font-weight: 600;">Konfirmasi Booking</h4>
                        
                        <div class="p-3 mb-4" style="background-color: #f3faf9; border-radius: 10px; border-left: 4px solid var(--accent);">
                            <p class="mb-1"><strong>Layanan:</strong> Konsultasi Online</p>
                            <p class="mb-1"><strong>Dokter:</strong> <span id="confirm-doctor">Belum dipilih</span></p>
                            <p class="mb-0"><strong>Jadwal:</strong> <span id="confirm-time">Belum dipilih</span></p>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" style="font-weight: 500;">Keluhan Singkat (Opsional)</label>
                            <textarea name="complaint" class="form-control" rows="3" placeholder="Ceritakan keluhan Anda agar dokter dapat mempersiapkan diri..." style="border-radius: 10px;"></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light px-4" style="border-radius: 20px;" onclick="prevStep(2)">Kembali</button>
                            <button type="submit" class="btn text-white px-4" style="background-color: var(--dark); border-radius: 20px;">Konfirmasi & Booking</button>
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
    .step-circle { width: 30px; height: 30px; border-radius: 50%; border: 2px solid #fff; display: flex; align-items: center; justify-content: center; font-weight: bold; }
    .active-step .step-circle { background-color: var(--accent); border-color: var(--accent); color: #fff; }
    
    .list-group-item:hover { background-color: #f8f9fa; }
    .list-group-item:has(input:checked) { border-color: var(--accent) !important; background-color: #f3faf9; }
    
    .time-pill { border-radius: 20px; border-color: var(--navy-mid); color: var(--navy-mid); }
    .btn-check:checked + .time-pill { background-color: var(--navy-mid); border-color: var(--navy-mid); color: white; }
    .time-pill:hover { background-color: var(--navy-light); color: white; border-color: var(--navy-light); }
</style>

<script>
    function validateStep(stepNumber) {
        if (stepNumber === 1) {
            let doc = document.querySelector('input[name="doctor_id"]:checked');
            if (!doc) {
                alert('Tolong pilih dokter terlebih dahulu');
                return false;
            }
        }
        if (stepNumber === 2) {
            let date = document.getElementById('booking_date').value;
            let time = document.querySelector('input[name="booking_time"]:checked');
            if (!date || !time) {
                alert('Tolong pilih tanggal dan jam terlebih dahulu');
                return false;
            }
        }
        return true;
    }

    function nextStep(stepNumber) {
        if(!validateStep(stepNumber - 1)) return;
        
        document.querySelectorAll('.form-step').forEach(el => el.classList.add('d-none'));
        document.getElementById('step-' + stepNumber).classList.remove('d-none');
        updateNav(stepNumber);
    }

    function prevStep(stepNumber) {
        document.querySelectorAll('.form-step').forEach(el => el.classList.add('d-none'));
        document.getElementById('step-' + stepNumber).classList.remove('d-none');
        updateNav(stepNumber);
    }

    function updateNav(stepNumber) {
        document.querySelectorAll('.step-indicator').forEach(el => el.classList.remove('active-step'));
        for(let i = 1; i <= stepNumber; i++) {
            document.getElementById('nav-step-' + i).classList.add('active-step');
        }
    }

    function updateSummary() {
        let selectedDoctor = document.querySelector('input[name="doctor_id"]:checked');
        if(selectedDoctor) {
            let docName = selectedDoctor.closest('.list-group-item').querySelector('h6').innerText;
            document.getElementById('summary-doctor').innerText = docName;
            document.getElementById('confirm-doctor').innerText = docName;
        }

        let date = document.getElementById('booking_date').value;
        let selectedTime = document.querySelector('input[name="booking_time"]:checked');
        if(date || selectedTime) {
            let timeText = selectedTime ? selectedTime.value : 'Pilih Jam';
            let dateText = date ? new Date(date).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'}) : 'Pilih Tanggal';
            let summaryString = dateText + ' | ' + timeText;
            document.getElementById('summary-time').innerText = summaryString;
            document.getElementById('confirm-time').innerText = summaryString;
        }
    }

    function filterDoctors() {
        let search = document.getElementById('doctorSearch').value.toLowerCase();
        let options = document.querySelectorAll('.doctor-option');
        
        options.forEach(option => {
            let text = option.innerText.toLowerCase();
            if(text.includes(search)) {
                option.style.setProperty('display', 'flex', 'important');
            } else {
                option.style.setProperty('display', 'none', 'important');
            }
        });
    }
</script>
@endsection
