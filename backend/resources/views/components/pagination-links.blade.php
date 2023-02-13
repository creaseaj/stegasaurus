@props([
'name',
'show' => false,
'maxWidth' => '2xl',
'paginator' => null,
])

@php
$maxWidth = [
'sm' => 'sm:max-w-sm',
'md' => 'sm:max-w-md',
'lg' => 'sm:max-w-lg',
'xl' => 'sm:max-w-xl',
'2xl' => 'sm:max-w-2xl',
][$maxWidth];
$page = $paginator->currentPage();
$lastPage = $paginator->lastPage();
$nextPage = $page >= $lastPage ? $lastPage : $page + 1;
$prevPage = $page <= 1 ? 1 : $page - 1; @endphp <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dark:text-gray-200 p-2 flex justify-between flex-row items-center">
    <div class="h-full flex content-center">
        Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} entries
    </div>
    <div class="flex">
        <a href="{{ route('media',['page'=>$prevPage]) }}" class="p-2 bg-slate-900 cursor-pointer hover:bg-slate-800 border-y-2 border-l-2 border-slate-700 rounded-l-md">
            {{ __('<') }}
        </a>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <a href="{{ route('media',['page'=>$i]) }}" class="p-2 bg-slate-900 cursor-pointer hover:bg-slate-800 border-y-2 border-slate-700">
                {{ $i }}
            </a>
            @endfor
            <a href="{{ route('media',['page'=>$nextPage]) }}" class="p-2 bg-slate-900 cursor-pointer hover:bg-slate-800 border-y-2 border-r-2 border-slate-700 rounded-r-md">
                {{ __('>') }}
            </a>
    </div>
    </div>