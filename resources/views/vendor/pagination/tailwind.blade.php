

@if ($paginator->hasPages())
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between px-4 py-3">

        {{-- SHOWING --}}
        <div>
            <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
                {!! __('Menampilkan') !!}
                @if ($paginator->firstItem())
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('ke') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('dari') !!}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {!! __('hasil') !!}
            </p>
        </div>

        {{-- PAGINATION --}}
        <nav class="flex items-center justify-center gap-2">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span
                    class="flex items-center justify-center w-9 h-9 rounded-full bg-gray-100 text-gray-400 cursor-not-allowed">
                    ‹
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="flex items-center justify-center w-9 h-9 rounded-full bg-white border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                    ‹
                </a>
            @endif

            {{-- Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="flex items-center justify-center w-9 h-9 rounded-full bg-gray-100 text-gray-400">
                        {{ $element }}
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="flex items-center justify-center w-9 h-9 rounded-full bg-emerald-600 text-white font-semibold shadow">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="flex items-center justify-center w-9 h-9 rounded-full bg-white border border-gray-300 text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="flex items-center justify-center w-9 h-9 rounded-full bg-white border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                    ›
                </a>
            @else
                <span
                    class="flex items-center justify-center w-9 h-9 rounded-full bg-gray-100 text-gray-400 cursor-not-allowed">
                    ›
                </span>
            @endif

        </nav>
    </div>
@endif
