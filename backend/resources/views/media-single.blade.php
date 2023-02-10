<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $media->filename}}
        </h2>
    </x-slot>
    <div class="max-w-6xl mx-auto my-2">
        @if (session('status') === 'deleted-success')
        <p x-data="{ show: true }" x-transition x-init="setTimeout(() => show = false, 5000)" :class='"text-sm text-gray-100 bg-red-500 p-2 rounded-sm w-full transition-all transition-duration-1000 " + (show ? "opacity-100" : "opacity-0") '>{{ __('Deleted.') }}</p>
        @endif
    </div>
    <div class="max-w-7xl mx-auto flex justify-center">
        <img src="{{ $media->url }}" alt="{{ $media->filename }}" class="object-fit max-w-[500px] max-h-[500px] h-full w-full" />
    </div>
</x-app-layout>