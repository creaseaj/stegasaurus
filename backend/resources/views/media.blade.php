<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Media') }}
        </h2>
    </x-slot>
    <div class="max-w-6xl mx-auto my-2">
        @if (session('status') === 'deleted-success')
        <p x-data="{ show: true }" x-transition x-init="setTimeout(() => show = false, 5000)" :class='"text-sm text-gray-100 bg-red-500 p-2 rounded-sm w-full transition-all transition-duration-1000 " + (show ? "opacity-100" : "opacity-0") '>{{ __('Deleted.') }}</p>
        @endif
    </div>
    <div class="py-6 max-w-7xl mx-auto px-6 sm:px-0" x-data="{isGrid:false}">
        <button @click="isGrid = !isGrid">
            Toggle
        </button>
        <div x-show="!isGrid" class="w-full">
            <table class="table-auto rounded-md overflow-hidden mx-auto text-lg relative">
                <thead class="bg-slate-800 text-slate-200 w-full">
                    <tr>
                        <th>
                            Filename
                        </th>
                        <th>
                            Size
                        </th>
                        <th>
                            Date Created
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-slate-700 text-slate-200 ">
                    @foreach ($media as $item)
                    <tr class="group cursor-pointer">
                        <td class="p-1 group-hover:bg-slate-800 transition-all"> {{ $item->filename }} </td>
                        <td class="p-1 group-hover:bg-slate-800 transition-all"> {{ $item->getFirstMedia()->human_readable_size }} </td>
                        <td class="p-1 group-hover:bg-slate-800 transition-all"> {{ $item->created_at }} </td>
                        <td class="p-1 group-hover:bg-slate-800 transition-all">
                            <a href="{{ route('media.id',['id'=>$item->id]) }}">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div x-show="isGrid">
            <div class="">
                <div class="flex flex-wrap gap-2 my-2 justify-center">
                    @foreach ($media as $item)
                    @if($item)
                    <div class="text-gray-900 dark:text-gray-100 rounded-md overflow-hidden relative h-[300px] w-max group flex-auto">
                        <img src="{{ $item->thumbnail}}" alt="{{ $item->name }}" class="object-cover w-full h-full ">
                        <form action="{{ route('media.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="absolute bottom-0 right-0 bg-red-400 p-[4px] rounded-md opacity-50 group-hover:opacity-100 transition-all cursor-pointer">Delete</button>
                        </form>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto pb-2">
        <x-pagination-links :paginator="$media" />
        @if ($media->count() === 0)
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("No Media Found") }}
            </div>
        </div>
        @endif
    </div>
</x-app-layout>