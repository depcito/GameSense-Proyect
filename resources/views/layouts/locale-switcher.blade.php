@php
    $currentLocale = app()->getLocale();
@endphp

<div class="{{ $wrapperClass ?? 'dropdown' }}">
    <button
        type="button"
        class="{{ $toggleClass ?? 'nav-link' }} dropdown-toggle d-flex align-items-center gap-1 border-0 bg-transparent"
        data-bs-toggle="dropdown"
        aria-expanded="false"
        aria-label="{{ __('layouts/locale-switcher.change_language') }}">

        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="2" y1="12" x2="22" y2="12"></line>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
        </svg>

        <span class="fw-semibold">{{ strtoupper($currentLocale) }}</span>
    </button>

    <form
        method="POST"
        action="{{ route('locale.update') }}"
        class="dropdown-menu {{ $menuClass ?? 'dropdown-menu-end' }} p-3"
        style="min-width: 230px;">
        @csrf

        <p class="small text-muted mb-2">{{ __('layouts/locale-switcher.choose_language') }}</p>

        @foreach (config('app.available_locales') as $code => $name)
            <div class="form-check mb-2">
                <input
                    class="form-check-input"
                    type="radio"
                    name="locale"
                    id="locale-{{ $code }}-{{ $wrapperId ?? 'nav' }}"
                    value="{{ $code }}"
                    @checked($currentLocale === $code)
                    onchange="this.form.submit()">

                <label class="form-check-label text-dark" for="locale-{{ $code }}-{{ $wrapperId ?? 'nav' }}">
                    {{ $name }} - {{ strtoupper($code) }}
                </label>
            </div>
        @endforeach
    </form>
</div>
