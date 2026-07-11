@extends('layouts.doctor')
@section('title', 'Sesi Konsultasi')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('doctor.consultations.index') }}" class="btn btn-sm btn-light" style="border-radius:8px;">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h5 class="fw-semibold mb-0" style="color:#0f172a;">Sesi Konsultasi</h5>
        <p class="text-muted mb-0" style="font-size:0.8rem;">Pasien: {{ $booking->user->name ?? '-' }}</p>
    </div>
</div>

<div class="row g-4">
    {{-- LEFT: Patient & booking info --}}
    <div class="col-lg-4">
        <div class="card-custom p-4 mb-4">
            <h6 class="fw-semibold mb-3" style="color:#0f172a;">Info Pasien</h6>
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                     style="width:48px; height:48px; font-size:1.2rem;">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div>
                    <div class="fw-semibold" style="color:#0f172a;">{{ $booking->user->name ?? '-' }}</div>
                    <small class="text-muted">{{ $booking->user->email ?? '' }}</small>
                </div>
            </div>
            <ul class="list-unstyled" style="font-size:0.85rem; color:#475569;">
                <li class="mb-2"><i class="bi bi-calendar3 me-2 text-primary"></i>
                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                </li>
                <li class="mb-2"><i class="bi bi-clock me-2 text-primary"></i>
                    {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}
                </li>
                @if($booking->complaint)
                <li><i class="bi bi-clipboard-pulse me-2 text-primary"></i>
                    {{ $booking->complaint }}
                </li>
                @endif
            </ul>
        </div>

        {{-- Close Consultation Button (only if ongoing) --}}
        @if($consultation->status === 'ongoing')
        <div class="card-custom p-4">
            <h6 class="fw-semibold mb-2" style="color:#0f172a;">Tutup Konsultasi</h6>
            <p class="text-muted mb-3" style="font-size:0.8rem;">Tutup sesi ini setelah konsultasi selesai dan berikan ringkasan untuk pasien.</p>
            <button class="btn btn-danger btn-sm w-100" style="border-radius:8px;" data-bs-toggle="modal" data-bs-target="#closeModal">
                <i class="bi bi-x-circle-fill me-1"></i>Tutup & Simpan Ringkasan
            </button>
        </div>
        @else
        <div class="card-custom p-4">
            <span class="badge bg-secondary px-3 py-2" style="border-radius:8px;">
                <i class="bi bi-lock-fill me-1"></i>Sesi Selesai
            </span>
            @if($consultation->ended_at)
                <p class="text-muted mt-2 mb-0" style="font-size:0.78rem;">Ditutup: {{ $consultation->ended_at->format('d M Y, H:i') }}</p>
            @endif
        </div>
        @endif
    </div>

    {{-- RIGHT: Chat window --}}
    <div class="col-lg-8">
        <div class="card-custom d-flex flex-column" style="height:580px;">
            {{-- Chat Header --}}
            <div class="d-flex align-items-center gap-3 px-4 py-3" style="background:var(--accent); border-radius:12px 12px 0 0;">
                <i class="bi bi-chat-dots-fill text-white fs-5"></i>
                <span class="text-white fw-semibold">Percakapan dengan {{ $booking->user->name ?? 'Pasien' }}</span>
                @if($consultation->status === 'ongoing')
                    <span class="ms-auto badge bg-white text-success" style="font-size:0.7rem;">
                        <i class="bi bi-circle-fill me-1" style="font-size:0.4rem;"></i>Live
                    </span>
                @endif
            </div>

            {{-- Messages --}}
            <div id="chat-box" class="flex-grow-1 p-4 overflow-auto" style="background:#f8fafc;">
                @forelse($messages as $msg)
                    @php $isMine = $msg->sender_id === auth()->id(); @endphp
                    <div class="d-flex {{ $isMine ? 'justify-content-end' : 'justify-content-start' }} mb-3">
                        <div style="max-width:70%;">
                            @if(!$isMine)
                                <div style="font-size:0.7rem; color:#94a3b8; margin-bottom:3px;">{{ $msg->sender->name ?? 'Pasien' }}</div>
                            @endif
                            <div class="px-3 py-2"
                                 style="border-radius:{{ $isMine ? '16px 16px 4px 16px' : '16px 16px 16px 4px' }};
                                        background:{{ $isMine ? 'var(--accent)' : 'white' }};
                                        color:{{ $isMine ? 'white' : '#1e293b' }};
                                        {{ $isMine ? '' : 'border:1px solid #e2e8f0;' }}
                                        font-size:0.875rem; box-shadow:0 1px 3px rgba(0,0,0,0.07);">
                                {{ $msg->message }}
                            </div>
                            <div style="font-size:0.68rem; color:#94a3b8; margin-top:3px; text-align:{{ $isMine ? 'right' : 'left' }};">
                                {{ $msg->sent_at->format('H:i') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-5" id="empty-state">
                        <i class="bi bi-chat-square-dots fs-1 mb-2 d-block" style="color:#cbd5e1;"></i>
                        <p style="font-size:0.85rem;">Belum ada pesan. Tunggu pesan dari pasien atau mulai sapaan.</p>
                    </div>
                @endforelse
            </div>

            {{-- Input --}}
            @if($consultation->status === 'ongoing')
            <div class="px-4 py-3 border-top bg-white" style="border-radius:0 0 12px 12px;">
                <div class="d-flex gap-2">
                    <textarea id="msg-input" rows="1" class="form-control" placeholder="Ketik balasan..."
                              style="border-radius:20px; resize:none; font-size:0.875rem;"
                              onkeydown="handleEnter(event)"></textarea>
                    <button id="send-btn" class="btn btn-primary px-4" style="border-radius:20px; white-space:nowrap;"
                            onclick="sendMessage()">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </div>
                <small class="text-muted mt-1 d-block" style="font-size:0.7rem;">Enter untuk kirim &bull; Shift+Enter untuk baris baru</small>
            </div>
            @else
            <div class="px-4 py-3 border-top bg-light text-center" style="border-radius:0 0 12px 12px;">
                <small class="text-muted"><i class="bi bi-lock-fill me-1"></i>Sesi ini telah ditutup.</small>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Close Consultation Modal --}}
@if($consultation->status === 'ongoing')
<div class="modal fade" id="closeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px; border:none;">
            <form action="{{ route('doctor.consultations.update', $consultation->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-semibold">Tutup Sesi Konsultasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted" style="font-size:0.85rem;">Berikan ringkasan atau catatan medis untuk pasien <strong>{{ $booking->user->name }}</strong>.</p>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:0.875rem;">Ringkasan Konsultasi (Opsional)</label>
                        <textarea name="summary" class="form-control" rows="5"
                                  placeholder="Contoh: Pasien mengeluh demam ringan selama 2 hari. Disarankan istirahat cukup dan minum obat penurun panas..."
                                  style="border-radius:10px; font-size:0.875rem;"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius:8px;">Batal</button>
                    <button type="submit" class="btn btn-danger" style="border-radius:8px;"
                            onclick="return confirm('Yakin ingin menutup sesi konsultasi ini?')">
                        <i class="bi bi-x-circle-fill me-1"></i>Tutup Konsultasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if($consultation->status === 'ongoing')
@push('scripts')
<script>
    const FETCH_URL  = "{{ route('consultation-messages.index', $consultation->id) }}";
    const STORE_URL  = "{{ route('consultation-messages.store', $consultation->id) }}";
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;
    let lastCount    = {{ count($messages) }};

    function scrollToBottom() {
        const box = document.getElementById('chat-box');
        box.scrollTop = box.scrollHeight;
    }

    function escapeHtml(str) {
        const d = document.createElement('div');
        d.textContent = str;
        return d.innerHTML;
    }

    function buildBubble(msg) {
        const align  = msg.is_mine ? 'justify-content-end' : 'justify-content-start';
        const bg     = msg.is_mine ? 'var(--accent)' : 'white';
        const color  = msg.is_mine ? 'white' : '#1e293b';
        const radius = msg.is_mine ? '16px 16px 4px 16px' : '16px 16px 16px 4px';
        const border = msg.is_mine ? '' : 'border:1px solid #e2e8f0;';
        const label  = msg.is_mine ? '' : `<div style="font-size:0.7rem;color:#94a3b8;margin-bottom:3px;">${msg.sender_name}</div>`;
        const tAlign = msg.is_mine ? 'right' : 'left';
        return `<div class="d-flex ${align} mb-3">
            <div style="max-width:70%;">
                ${label}
                <div class="px-3 py-2" style="border-radius:${radius};background:${bg};color:${color};${border}font-size:0.875rem;">
                    ${escapeHtml(msg.message)}
                </div>
                <div style="font-size:0.68rem;color:#94a3b8;margin-top:3px;text-align:${tAlign};">${msg.sent_at}</div>
            </div>
        </div>`;
    }

    function pollMessages() {
        fetch(FETCH_URL, { headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN } })
            .then(r => r.json())
            .then(msgs => {
                if (msgs.length > lastCount) {
                    const box   = document.getElementById('chat-box');
                    const empty = document.getElementById('empty-state');
                    if (empty) empty.remove();
                    msgs.slice(lastCount).forEach(m => box.insertAdjacentHTML('beforeend', buildBubble(m)));
                    lastCount = msgs.length;
                    scrollToBottom();
                }
            });
    }

    function sendMessage() {
        const input = document.getElementById('msg-input');
        const text  = input.value.trim();
        if (!text) return;
        document.getElementById('send-btn').disabled = true;

        fetch(STORE_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
            body: JSON.stringify({ message: text }),
        })
        .then(r => r.json())
        .then(msg => {
            if (msg.error) { alert(msg.error); return; }
            const box   = document.getElementById('chat-box');
            const empty = document.getElementById('empty-state');
            if (empty) empty.remove();
            box.insertAdjacentHTML('beforeend', buildBubble(msg));
            lastCount++;
            scrollToBottom();
            input.value = '';
        })
        .finally(() => {
            document.getElementById('send-btn').disabled = false;
            document.getElementById('msg-input').focus();
        });
    }

    function handleEnter(e) {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
    }

    scrollToBottom();
    setInterval(pollMessages, 3000);
</script>
@endpush
@endif
@endsection
