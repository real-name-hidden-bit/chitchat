@props(['user', 'size' => 'md'])

@php
    $sizeClasses = [
        'sm' => 'w-8 h-8 text-base',
        'md' => 'w-12 h-12 text-xl',
        'lg' => 'w-16 h-16 text-3xl',
        'xl' => 'w-32 h-32 text-6xl',
    ];
    $class = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<div {{ $attributes->merge(['class' => "$class bg-sky-500 rounded-full flex items-center justify-center text-white font-bold"]) }}>
    @if($user->profile_picture)
        <span class="{{ $size === 'xl' ? 'text-7xl' : '' }}">{{ $user->profile_picture }}</span>
    @else
        {{ strtoupper(substr($user->name, 0, 1)) }}
    @endif
</div>
