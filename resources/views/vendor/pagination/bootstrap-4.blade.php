@if ($paginator->hasPages())
<nav>
    <ul class="pagination pagination-lg">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span class="page-link" aria-hidden="true">Sebelumnya</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Sebelumnya</a>
        </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Selanjutnya</a>
        </li>
        @else
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span class="page-link" aria-hidden="true">Selanjutnya</span>
        </li>
        @endif
    </ul>
    <ul class="pagination pagination-lg">
        <?php if (ceil($paginator->total() / $paginator->perPage()) < 5) : ?>
            <?php for ($p = 1; $p < ceil($paginator->total() / $paginator->perPage()) + 1; $p++) : ?>
                <li class="page-item <?php echo ($paginator->currentPage() == $p) ? "disabled" : ""; ?>" <?php ($paginator->currentPage() == $p) ? "aria-disabled='true'" : ""; ?>><a class="page-link" href="{{ $paginator->url($p) }}">{{ $p }}</a></li>
            <?php endfor; ?>
        <?php else : ?>
            <?php if ($paginator->currentPage() < 3) : ?>
                <?php for ($p = 1; $p < 6; $p++) : ?>
                    <li class="page-item <?php echo ($paginator->currentPage() == $p) ? "disabled" : ""; ?>" <?php ($paginator->currentPage() == $p) ? "aria-disabled='true'" : ""; ?>><a class="page-link" href="{{ $paginator->url($p) }}">{{ $p }}</a></li>
                <?php endfor; ?>
            <?php elseif ($paginator->currentPage() > ceil($paginator->total() / $paginator->perPage()) - 3) : ?>
                <?php for ($p = ceil($paginator->total() / $paginator->perPage()) - 5; $p < ceil($paginator->total() / $paginator->perPage()) + 1; $p++) : ?>
                    <li class="page-item <?php echo ($paginator->currentPage() == $p) ? "disabled" : ""; ?>" <?php ($paginator->currentPage() == $p) ? "aria-disabled='true'" : ""; ?>><a class="page-link" href="{{ $paginator->url($p) }}">{{ $p }}</a></li>
                <?php endfor; ?>
            <?php else : ?>
                <?php for ($p = $paginator->currentPage() - 2; $p < $paginator->currentPage() + 3; $p++) : ?>
                    <li class="page-item <?php echo ($paginator->currentPage() == $p) ? "disabled" : ""; ?>" <?php ($paginator->currentPage() == $p) ? "aria-disabled='true'" : ""; ?>><a class="page-link" href="{{ $paginator->url($p) }}">{{ $p }}</a></li>
                <?php endfor; ?>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
</nav>
@endif