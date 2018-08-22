@if ($paginator->hasPages())

    <pagination paginator_="{{ json_encode($paginator) }}"></pagination>

@endif
