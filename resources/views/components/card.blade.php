<div class="row col-md-5 col-lg-4">  
    <div class="card p-0">
      <img src="images/inside-masjid.jpg" class="card-img-top image-inside-masjid" alt="card">
      <div class="card-body">
        <div class="row d-flex justify-content-between">
          <h4 class="h4 fw-bold">{{$title}}</h4>
          <div class="row d-flex my-1">
            <span class="box_aktivitas py-1 fs-6 fw-medium rounded" style="width: max-content;">{{$tag}}</span>
            <span class="p-1 fw-medium rounded mx-2" style="width: max-content; text-transform: capitalize; font-size:0.9rem; @if($status === 'masih berjalan') border: 2px solid #1DA599; color: #1DA599; @else border: 2px solid red; color: red;  @endif  ">{{$status}}</span>
          </div>
          <p class="card-text">{{$slot}}</p>
        </div>
      </div>
    </div>
</div>