<div class="border-top-light mt-30 pt-30">
    <div class="row x-gap-10 y-gap-20 justify-between md:justify-center">
        <div class="col-auto md:order-1">
            <a href="{{ $paginator->previousPageUrl() }}" class="button -blue-1 size-40 rounded-full border-light" {{ $paginator->onFirstPage() ? 'disabled' : '' }}>
                <i class="icon-chevron-left text-12"></i>
            </a>
        </div>

        <div class="col-md-auto md:order-3">
            <div class="row x-gap-20 y-gap-20 items-center md:d-none">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <div class="col-auto">
                            <div class="size-40 flex-center rounded-full">{{ $element }}</div>
                        </div>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <div class="col-auto">
                                <div class="size-40 flex-center rounded-full {{ $page == $paginator->currentPage() ? 'bg-dark-1 text-white' : '' }}">
                                    <a href="{{ $url }}">{{ $page }}</a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>

        <div class="col-auto md:order-2">
            <a href="{{ $paginator->nextPageUrl() }}" class="button -blue-1 size-40 rounded-full border-light" {{ $paginator->currentPage() == $paginator->lastPage() ? 'disabled' : '' }}>
                <i class="icon-chevron-right text-12"></i>
            </a>
        </div>
    </div>
</div>
