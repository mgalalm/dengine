@props(['title' => null])
<div {{ $attributes->class(['bg-white rounded-lg shadow p-4 ']) }} >
    @if($title)
        <h2 class="text-lg font-semibold mb-4">{{ $title }}</h2>
    @endif
    {{ $slot }}
</div>
