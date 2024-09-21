<div class="col-md-5 col-lg-4 col-xxl-3 p-3 border rounded">
    <div class="col" style="height: max-content;">
        {{$icon}}
        {{-- <i class="bi bi-graph-up-arrow float-end fs-3 mx-2 fw-bold"></i> --}}
        <h6 class="fs-6 mb-3">
            {{$slot}}
        </h6>
        @if (!empty($total))
            <span class="display-6 fw-bold fs-4">{{ $total_true}}</span>
        @else
            <span class="display-6 fw-bold fs-4">{{$total_false}}</span>
        @endif
    </div>
</div>