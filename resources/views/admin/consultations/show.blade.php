@extends('layouts.admin')
@section('title', 'Detail Konsultasi')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('admin.consultations.index') }}" class="btn btn-sm btn-light" style="border-radius:8px;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h5 class="fw-semibold mb-0" style="color:#0f172a;">Detail Konsultasi</h5>
        <p class="text-muted mb-0" style="font-size:0.8rem;">
            Antara {{ $booking->user->name ?? '-' }} & Dr. {{ $booking->doctor->name ?? '-' }}
        </p>
    </div>
    <span class="ms-auto badge px-3 py-2" style="border-radius:8px; font-size:0.8rem;
        background:{{ $consultation->status === 'ongoing' ? 'rgba(34,197,94,0.1)' : 'rgba(148,163,184,0.15)' }};
        color:{{ $consultation->status === 'ongoing' ? '#16a34a' : '#64748b' }};">
        <i class="bi bi-{{ $consultation->status === 'ongoing' ? 'circle-fill' : 'lock-fill' }} me-1"
           style="{{ $consultation->status === 'ongoing' ? 'font-size:0.5rem; vertical-align:middle;' : '' }}"></i>
        {{ $consultation->status === 'ongoing' ? 'Berlangsung' : 'Selesai' }}
    </span>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card-custom p-4 mb-4">
            <h6 class="fw-semibold mb-3" style="color:#0f172a;">Info Pasien</h6>
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                     style="width:48px; height:48px; font-size:1.2rem;">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div>
                    <div class="fw-semibold" style="color:#0f172a; font-size:0.9rem;">{{ $booking->user->name ?? '-' }}</div>
                    <small class="text-muted">{{ $booking->user->email ?? '' }}</small>
                </div>
            </div>
        </div>

        <div class="card-custom p-4 mb-4">
            <h6 class="fw-semibold mb-3" style="color:#0f172a;">Info Dokter</h6>
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center"
                     style="width:48px; height:48px; font-size:1.2rem;">
                    <i class="bi bi-hospital-fill"></i>
                </div>
                <div>
                    <div class="fw-semibold" style="color:#0f172a; font-size:0.9rem;">{{ $booking->doctor->name ?? '-' }}</div>
                    <small class="text-muted">{{ $booking->doctor->specialization ?? '' }}</small>
                </div>
            </div>
        </div>

        <div class="card-custom p-4 mb-4">
            <h6 class="fw-semibold mb-3" style="color:#0f172a;">Detail Sesi</h6>
            <ul class="list-unstyled mb-0" style="font-size:0.85rem; color:#475569;">
                <li class="mb-2">
                    <i class="bi bi-calendar3 me-2 text-primary"></i>
                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                </li>
                <li class="mb-2">
                    <i class="bi bi-clock me-2 text-primary"></i>
                    {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}
                </li>
                <li class="mb-2">
                    <i class="bi bi-play-circle me-2 text-success"></i>
                    Dimulai: {{ $consultation->started_at?->format('d M Y, H:i') ?? '-' }}
                </li>
                <li class="mb-2">
                    <i class="bi bi-stop-circle me-2 text-danger"></i>
                    Selesai: {{ $consultation->ended_at?->format('d M Y, H:i') ?? 'Belum selesai' }}
                </li>
                @if($booking->complaint)
                <li>
                    <i class="bi bi-clipboard-pulse me-2 text-warning"></i>
                    {{ $booking->complaint }}
                </li>
                @endif
            </ul>
        </div>

        @if($consultation->status === 'closed' && $consultation->summary)
        <div class="card-custom p-4">
            <h6 class="fw-semibold mb-2" style="color:#0f172a;">Ringkasan Dokter</h6>
            <p style="font-size:0.85rem; color:#334155; background:#f8fafc; border-radius:8px;
                      padding:12px; border-left:3px solid var(--accent); margin-bottom:0;">
                {{ $consultation->summary }}
            </p>
        </div>
        @endif
    </div>

    <div class="col-lg-8">
        <div class="card-custom d-flex flex-column" style="height:580px;">
            <div class="d-flex align-items-center gap-3 px-4 py-3"
                 style="background:var(--accent); border-radius:12px 12px 0 0;">
                <i class="bi bi-chat-dots-fill text-white fs-5"></i>
                <span class="text-white fw-semibold">Riwayat Percakapan</span>
                <span class="ms-auto badge bg-white text-secondary" style="font-size:0.75rem; border-radius:6px;">
                    <i class="bi bi-shield-lock-fill me-1"></i>Mode Admin (Hanya Baca)
                </span>
            </div>

            <div id="chat-box" class="flex-grow-1 p-4 overflow-auto" style="background:#f8fafc;">
                @forelse($messages as $msg)
                    @php
                        $isMember = $msg->sender->role === 'member';
                    @endphp
                    <div class="d-flex {{ $isMember ? 'justify-content-start' : 'justify-content-end' }} mb-3">
                        <div style="max-width:70%;">
                            <div style="font-size:0.7rem; color:#94a3b8; margin-bottom:3px;
                                        text-align:{{ $isMember ? 'left' : 'right' }};">
                                {{ $msg->sender->name ?? 'Unknown' }}
                                <span class="badge ms-1 px-1"
                                      style="font-size:0.6rem; background:{{ $isMember ? '#dbeafe' : '#dcfce7' }};
                                             color:{{ $isMember ? '#1d4ed8' : '#15803d' }}; border-radius:4px;">
                                    {{ ucfirst($msg->sender->role) }}
                                </span>
                            </div>
                            <div class="px-3 py-2"
                                 style="border-radius:{{ $isMember ? '16px 16px 16px 4px' : '16px 16px 4px 16px' }};
                                        background:{{ $isMember ? 'white' : 'var(--accent)' }};
                                        color:{{ $isMember ? '#1e293b' : 'white' }};
                                        {{ $isMember ? 'border:1px solid #e2e8f0;' : '' }}
                                        font-size:0.875rem; box-shadow:0 1px 3px rgba(0,0,0,0.07);">
                                {{ $msg->message }}
                            </div>
                            <div style="font-size:0.68rem; color:#94a3b8; margin-top:3px;
                                        text-align:{{ $isMember ? 'left' : 'right' }};">
                                {{ $msg->sent_at->format('H:i') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-chat-square-dots fs-1 mb-2 d-block" style="color:#cbd5e1;"></i>
                        <p style="font-size:0.85rem;">Belum ada pesan dalam sesi konsultasi ini.</p>
                    </div>
                @endforelse
            </div>

            <div class="px-4 py-3 border-top bg-light text-center" style="border-radius:0 0 12px 12px;">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Admin hanya dapat melihat percakapan, tidak dapat mengirim pesan.
                </small>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('chat-box').scrollTop = document.getElementById('chat-box').scrollHeight;
</script>
@endpush
@endsection
