@extends('layouts.member')
@section('title', $consultation->status === 'ongoing' ? 'Sesi Konsultasi' : 'Riwayat Konsultasi')

@section('content')
<div class="container my-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <a href="{{ route('member.consultations.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <h4 style="font-family:'Sora',sans-serif; color:var(--dark); font-weight:700; margin:0;">
                @if($consultation->status === 'ongoing')
                    <i class="bi bi-chat-dots-fill me-2" style="color:var(--accent);"></i>Sesi Konsultasi Berlangsung
                @else
                    <i class="bi bi-clock-history me-2" style="color:var(--dark);"></i>Riwayat Konsultasi
                @endif
            </h4>
        </div>

        @if($consultation->status === 'ongoing')
            <span class="badge" style="background:#e2f6f4; color:var(--accent); font-size:0.8rem; padding:8px 16px; border-radius:20px;">
                <span class="me-1" style="display:inline-block; width:8px; height:8px; background:var(--accent); border-radius:50%; animation: pulse 1.5s infinite;"></span>
                Aktif
            </span>
        @else
            <span class="badge bg-secondary" style="font-size:0.8rem; padding:8px 16px; border-radius:20px;">Selesai</span>
        @endif
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color:var(--dark);">Info Konsultasi</h6>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img src="{{ $booking->doctor->image ? asset($booking->doctor->image) : asset('images/doctors/default-article.jpg') }}"
                             class="rounded-circle" style="width:56px; height:56px; object-fit:cover; border:2px solid var(--accent);">
                        <div>
                            <div class="fw-semibold" style="color:var(--dark);">{{ $booking->doctor->name }}</div>
                            <small style="color:var(--accent);">{{ $booking->doctor->specialization }}</small>
                        </div>
                    </div>
                    <ul class="list-unstyled" style="font-size:0.85rem; color:#475569;">
                        <li class="mb-2"><i class="bi bi-calendar3 me-2" style="color:var(--accent);"></i>
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                        </li>
                        <li class="mb-2"><i class="bi bi-clock me-2" style="color:var(--accent);"></i>
                            {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}
                        </li>
                        @if($booking->complaint)
                        <li class="mb-2"><i class="bi bi-clipboard-pulse me-2" style="color:var(--accent);"></i>
                            {{ $booking->complaint }}
                        </li>
                        @endif
                        <li><i class="bi bi-hourglass-split me-2" style="color:var(--accent);"></i>
                            Dimulai: {{ $consultation->started_at?->format('d M Y, H:i') ?? '-' }}
                        </li>
                    </ul>

                    @if($consultation->status === 'closed' && $consultation->summary)
                        <hr>
                        <h6 class="fw-bold mb-2" style="color:var(--dark);">Ringkasan Dokter</h6>
                        <p style="font-size:0.85rem; color:#334155; background:#f3faf9; border-radius:10px; padding:12px; border-left:4px solid var(--accent);">
                            {{ $consultation->summary }}
                        </p>
                        @if($consultation->ended_at)
                            <small class="text-muted"><i class="bi bi-check-circle-fill me-1 text-success"></i>
                                Selesai: {{ $consultation->ended_at->format('d M Y, H:i') }}
                            </small>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm d-flex flex-column" style="border-radius:16px; overflow:hidden; height:580px;">
                <div class="d-flex align-items-center gap-3 px-4 py-3" style="background:var(--dark); border-radius:16px 16px 0 0;">
                    <i class="bi bi-chat-dots-fill text-white fs-5"></i>
                    <span class="text-white fw-semibold">Percakapan</span>
                </div>

                <div id="chat-box" class="flex-grow-1 p-4 overflow-auto" style="background:#f8fafc;">
                    @forelse($messages as $msg)
                        @php $isMine = $msg->sender_id === auth()->id(); @endphp
                        <div class="d-flex {{ $isMine ? 'justify-content-end' : 'justify-content-start' }} mb-3">
                            <div style="max-width:70%;">
                                @if(!$isMine)
                                    <div style="font-size:0.7rem; color:#94a3b8; margin-bottom:3px;">
                                        {{ $msg->sender->name ?? 'Unknown' }}
                                    </div>
                                @endif
                                <div class="px-3 py-2 {{ $isMine ? 'text-white' : 'text-dark bg-white border' }}"
                                     style="border-radius: {{ $isMine ? '16px 16px 4px 16px' : '16px 16px 16px 4px' }};
                                            background: {{ $isMine ? 'var(--accent)' : '' }};
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
                            <p style="font-size:0.85rem;">Belum ada pesan. Mulailah percakapan!</p>
                        </div>
                    @endforelse
                </div>

                @if($consultation->status === 'ongoing')
                <div class="px-4 py-3 border-top bg-white">
                    <div class="d-flex gap-2">
                        <textarea id="msg-input" rows="1" class="form-control" placeholder="Ketik pesan..."
                                  style="border-radius:20px; resize:none; font-size:0.875rem;"
                                  onkeydown="handleEnter(event)"></textarea>
                        <button id="send-btn" class="btn text-white px-4"
                                style="border-radius:20px; background:var(--accent); white-space:nowrap;"
                                onclick="sendMessage()">
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </div>
                    <small class="text-muted mt-1 d-block" style="font-size:0.7rem;">Enter untuk kirim &bull; Shift+Enter untuk baris baru</small>
                </div>
                @else
                <div class="px-4 py-3 border-top bg-light text-center">
                    <small class="text-muted"><i class="bi bi-lock-fill me-1"></i>Sesi konsultasi ini telah ditutup. Percakapan tidak dapat dilanjutkan.</small>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($consultation->status === 'ongoing')
@push('scripts')
<script>
    const CONSULTATION_ID = {{ $consultation->id }};
    const FETCH_URL       = "{{ route('consultation-messages.index', $consultation->id) }}";
    const STORE_URL       = "{{ route('consultation-messages.store', $consultation->id) }}";
    const CSRF_TOKEN      = document.querySelector('meta[name="csrf-token"]').content;

    let lastMessageCount = {{ count($messages) }};

    function scrollToBottom() {
        const box = document.getElementById('chat-box');
        box.scrollTop = box.scrollHeight;
    }

    function buildBubble(msg) {
        const align = msg.is_mine ? 'justify-content-end' : 'justify-content-start';
        const bubbleStyle = msg.is_mine
            ? 'background:var(--accent); color:white; border-radius:16px 16px 4px 16px;'
            : 'background:white; color:#1e293b; border:1px solid #e2e8f0; border-radius:16px 16px 16px 4px;';
        const senderLabel = msg.is_mine ? '' : `<div style="font-size:0.7rem;color:#94a3b8;margin-bottom:3px;">${msg.sender_name}</div>`;
        const timeAlign = msg.is_mine ? 'right' : 'left';

        return `
            <div class="d-flex ${align} mb-3">
                <div style="max-width:70%;">
                    ${senderLabel}
                    <div class="px-3 py-2" style="${bubbleStyle} font-size:0.875rem; box-shadow:0 1px 3px rgba(0,0,0,0.07);">
                        ${escapeHtml(msg.message)}
                    </div>
                    <div style="font-size:0.68rem;color:#94a3b8;margin-top:3px;text-align:${timeAlign};">${msg.sent_at}</div>
                </div>
            </div>`;
    }

    function escapeHtml(str) {
        const d = document.createElement('div');
        d.textContent = str;
        return d.innerHTML;
    }

    function pollMessages() {
        fetch(FETCH_URL, { headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' } })
            .then(r => r.json())
            .then(messages => {
                if (messages.length > lastMessageCount) {
                    const box = document.getElementById('chat-box');
                    const empty = document.getElementById('empty-state');
                    if (empty) empty.remove();

                    const newMsgs = messages.slice(lastMessageCount);
                    newMsgs.forEach(msg => box.insertAdjacentHTML('beforeend', buildBubble(msg)));
                    lastMessageCount = messages.length;
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
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ message: text }),
        })
        .then(r => r.json())
        .then(msg => {
            if (msg.error) { alert(msg.error); return; }

            const box   = document.getElementById('chat-box');
            const empty = document.getElementById('empty-state');
            if (empty) empty.remove();

            box.insertAdjacentHTML('beforeend', buildBubble(msg));
            lastMessageCount++;
            scrollToBottom();
            input.value = '';
        })
        .finally(() => {
            document.getElementById('send-btn').disabled = false;
            document.getElementById('msg-input').focus();
        });
    }

    function handleEnter(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    }

    scrollToBottom();
    setInterval(pollMessages, 3000);
</script>

<style>
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50%       { opacity: 0.3; }
    }
</style>
@endpush
@endif

@endsection
