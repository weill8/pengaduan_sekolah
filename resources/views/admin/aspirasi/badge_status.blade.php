{{-- @php
    $map = [
        'menunggu' => 'bg-yellow-100 text-yellow-800',
        'proses'   => 'bg-blue-100 text-blue-800',
        'selesai'  => 'bg-green-100 text-green-800',
    ];
    $class = $map[$status] ?? 'bg-gray-100 text-gray-700';
@endphp
<span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $class }}">
    {{ ucfirst($status) }}
</span> --}}