{{-- SweetAlert2 Library --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Modern & Clean Styling for SweetAlert2 --}}
<style>
    .swal2-container {
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        backdrop-filter: blur(4px) !important;
        -webkit-backdrop-filter: blur(4px) !important;
    }

    .swal2-popup {
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        border-radius: 24px !important;
        padding: 30px 24px 26px !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
        border: none !important;
        max-width: 400px !important;
        width: 92% !important;
        background: #ffffff !important;
    }

    .dark .swal2-popup {
        background: #18181b !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6) !important;
    }

    .swal2-title {
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        font-size: 1.35rem !important;
        font-weight: 800 !important;
        letter-spacing: -0.02em !important;
        color: #111827 !important;
        padding: 0 !important;
        margin: 4px 0 0 !important;
    }

    .dark .swal2-title {
        color: #f4f4f5 !important;
    }

    .swal2-html-container {
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        font-size: 0.925rem !important;
        color: #4b5563 !important;
        font-weight: 500 !important;
        line-height: 1.6 !important;
        margin: 10px 0 0 !important;
        padding: 0 4px !important;
    }

    .dark .swal2-html-container {
        color: #a1a1aa !important;
    }

    /* Icons - Scaled together from center to keep X-mark and checkmark 100% synchronized */
    .swal2-icon {
        margin: 0.5rem auto 1rem !important;
        transform: scale(0.88) !important;
        transform-origin: center center !important;
    }

    /* Error Icon */
    .swal2-icon.swal2-error {
        border-color: #ef4444 !important;
        color: #ef4444 !important;
    }

    .swal2-icon.swal2-error [class^='swal2-x-mark-line'] {
        background-color: #ef4444 !important;
    }

    /* Success Icon */
    .swal2-icon.swal2-success {
        border-color: #10b981 !important;
        color: #10b981 !important;
    }

    .swal2-icon.swal2-success [class^='swal2-success-line'] {
        background-color: #10b981 !important;
    }

    .swal2-icon.swal2-success .swal2-success-ring {
        border-color: rgba(16, 185, 129, 0.3) !important;
    }

    /* Warning Icon */
    .swal2-icon.swal2-warning {
        border-color: #f59e0b !important;
        color: #f59e0b !important;
    }

    /* Info Icon */
    .swal2-icon.swal2-info {
        border-color: #0ea5e9 !important;
        color: #0ea5e9 !important;
    }

    /* Question Icon */
    .swal2-icon.swal2-question {
        border-color: #64748b !important;
        color: #64748b !important;
    }

    /* Actions & Buttons */
    .swal2-actions {
        margin-top: 1.5rem !important;
        gap: 0.75rem !important;
        width: 100% !important;
        justify-content: center !important;
    }

    .swal2-styled.swal2-confirm {
        border-radius: 12px !important;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        font-weight: 700 !important;
        font-size: 0.9rem !important;
        padding: 0.75rem 2.25rem !important;
        letter-spacing: 0.01em !important;
        transition: all 0.2s ease !important;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12) !important;
        border: none !important;
        outline: none !important;
    }

    .swal2-styled.swal2-confirm:hover {
        transform: translateY(-1px) !important;
        filter: brightness(1.08) !important;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.18) !important;
    }

    .swal2-styled.swal2-confirm:active {
        transform: translateY(0) !important;
    }

    .swal2-styled.swal2-cancel {
        border-radius: 12px !important;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        font-weight: 600 !important;
        font-size: 0.9rem !important;
        padding: 0.75rem 1.75rem !important;
        background-color: #f1f5f9 !important;
        color: #475569 !important;
        border: none !important;
        transition: all 0.2s ease !important;
        outline: none !important;
    }

    .swal2-styled.swal2-cancel:hover {
        background-color: #e2e8f0 !important;
        color: #0f172a !important;
    }

    .dark .swal2-styled.swal2-cancel {
        background-color: #27272a !important;
        color: #e4e4e7 !important;
    }

    .swal2-timer-progress-bar {
        background: rgba(16, 185, 129, 0.7) !important;
        height: 3px !important;
    }
</style>

{{-- Automated Notification Triggers --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: {!! json_encode(session('success')) !!},
                confirmButtonText: 'Selesai',
                confirmButtonColor: '#059669',
                timer: 3500,
                timerProgressBar: true
            });
        @endif

        @if(session('status'))
            Swal.fire({
                icon: 'success',
                title: 'Informasi',
                text: {!! json_encode(session('status')) !!},
                confirmButtonText: 'OK',
                confirmButtonColor: '#059669',
                timer: 3500,
                timerProgressBar: true
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: {!! json_encode(session('error')) !!},
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#dc2626',
            });
        @endif

        @if($errors->any())
            @php
                $errorCount = $errors->count();
                if ($errorCount === 1) {
                    $valHtml = '<p class="text-sm sm:text-[15px] font-medium leading-relaxed my-1">' .
                        e($errors->first()) .
                        '</p>';
                } else {
                    $itemsHtml = '';
                    foreach ($errors->all() as $errorMsg) {
                        $itemsHtml .= '<li class="flex items-start gap-2.5 text-xs sm:text-sm font-medium leading-relaxed">' .
                            '<span class="text-red-500 font-bold shrink-0 mt-0.5">•</span>' .
                            '<span>' . e($errorMsg) . '</span></li>';
                    }
                    $valHtml = '<ul class="space-y-2 text-left my-2 px-1">' . $itemsHtml . '</ul>';
                }
            @endphp
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: {!! json_encode($valHtml) !!},
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#dc2626',
            });
        @endif
    });
</script>
