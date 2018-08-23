{{--@if ($paginator->hasPages())--}}
@if ($paginator)

    <pagination paginator_="{{ json_encode($paginator) }}"></pagination>

@endif
