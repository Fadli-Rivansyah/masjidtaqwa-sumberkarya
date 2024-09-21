<div class="container-fluid mb-4">
    <nav class="container navbar navbar-expand-lg ">
        <div class="container-fluid">
      <a class="navbar-brand fw-bold" style="color: #1DA599" href="/">Masjid Taqwa</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto d-flex justify-content-evenly col-md-12 col-lg-7">
          <li class="nav-item">
            <a class="nav-link d-flex gap-2 align-items-center fw-medium @if($title == 'Dashboard') active-navbar  @endif" aria-current="page" href="{{route('dashboard')}}"><i class="bi bi-house-door fs-5"></i> Dashboard</a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link fw-medium @if($title == 'Infaq Masjid' || $title == 'GAS (Gerakan Amal Sholeh)')  active-navbar  @endif d-flex gap-2 align-items-center dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-wallet fs-5"></i> KAS
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item fw-medium" href="{{route('keuangan')}}">Keuangan</a></li>
                    <li><a class="dropdown-item fw-medium" href="{{route('gas')}}">GAS (Gerakan Amal Sholeh)</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex gap-2 align-items-center fw-medium @if($title == 'Zakat') active-navbar  @endif" href="{{route('zakat')}}"><i class="bi bi-person-raised-hand fs-5"></i> Zakat Fitra</a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex gap-2 align-items-center fw-medium @if($title == 'Qurban') active-navbar  @endif"  href="{{route('qurban')}}"><i class="bi bi-people fs-5"></i> Qurban</a>
            </li>
        </ul>
        <div class="dropdown">
          <a class="btn outline-none dropdown-toggle fw-medium" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hi {{auth()->user()->name}}!!
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item d-flex gap-2 fw-medium" href="{{route('setting')}}"><i class="bi bi-gear"></i> Setting</a></li>
            <li><a class="dropdown-item d-flex gap-2 fw-medium" href="{{route('help')}}"><i class="bi bi-question-circle"></i></i> Help</a></li>
            <li><a class="dropdown-item d-flex gap-2 fw-medium" href="/logout"><i class="bi bi-box-arrow-in-left"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</div>