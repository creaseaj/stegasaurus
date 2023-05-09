<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Media') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto my-2">
        @if (session('status') === 'deleted-success')
        <p x-data="{ show: true }" x-transition x-init="setTimeout(() => show = false, 5000)" :class='"text-sm text-gray-100 bg-red-500 p-2 rounded-sm w-full transition-all transition-duration-1000 " + (show ? "opacity-100" : "opacity-0") '>{{ __('Deleted.') }}</p>
        @endif
    </div>
    <div class="px-6 py-6 mx-auto max-w-7xl sm:px-0" x-data="{isGrid:$persist(true)}">
        <div class="relative flex gap-4 p-2 overflow-hidden rounded-md bg-slate-800 w-max" @click="isGrid = !isGrid">
            <x-list-grid />
            <x-list-icon />
            <div :class='"h-full bg-sky-200 absolute top-0 bottom-0 opacity-50 rounded-md transition-all " + (isGrid ? "left-0  right-[50%]" : "right-0 left-[50%]")'>

            </div>
        </div>
        <div x-show="!isGrid" class="w-full">
            <table class="relative mx-auto overflow-hidden text-lg rounded-md table-auto">
                <thead class="w-full bg-slate-800 text-slate-200">
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
                        <th class="px-2">
                            Message Discovered
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-slate-700 text-slate-200 ">
                    @foreach ($media as $item)
                    <tr class="cursor-pointer group">
                        <td class="p-1 transition-all group-hover:bg-slate-800"> {{ $item->filename }} </td>
                        <td class="p-1 transition-all group-hover:bg-slate-800"> {{ $item->getFirstMedia()->human_readable_size }} </td>
                        <td class="p-1 transition-all group-hover:bg-slate-800"> {{ $item->created_at }} </td>
                        <td class="p-1 transition-all group-hover:bg-slate-800"> {{ $item->contents ? 'Yes' : 'No' }} </td>
                        <td class="p-1 transition-all group-hover:bg-slate-800">
                            <a href="{{ route('media.id',['id'=>$item->id]) }}">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div x-show="isGrid">
            <div class="">
                <div class="flex flex-wrap justify-center gap-2 my-2">
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
    <div class="pb-2 mx-auto max-w-7xl">
        <x-pagination-links :paginator="$media" />
        @if ($media->count() === 0)
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("No Media Found") }}
            </div>
        </div>
        @endif
    </div>
</x-app-layout>