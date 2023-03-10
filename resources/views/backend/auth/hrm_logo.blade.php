<div class="sidebar-top-side ">
    <a href="{{ route('admin.dashboard') }}" class="img-tag">
        @if(env('FILESYSTEM_DRIVER') == 'server')
        <img src="{{ Storage::disk('s3')->url(config('settings.app')['company_logo_frontend']) }}"
            class="hourworx-logo-img" alt="{{ config('app.name') }}" width="499">
        @elseif(env('FILESYSTEM_DRIVER') == 'local')
        <img src="{{Storage::disk('public')->url(config('settings.app')['company_logo_frontend111'])}}" class="hourworx-logo-img"
            alt="{{ config('app.name') }}" width="499">
        @else
        <img src="{{ Storage::url(config('settings.app')['company_logo_frontend']) }}" class="hourworx-logo-img"
            alt="{{ config('app.name') }}" width="499">
        @endif
    </a>
</div>