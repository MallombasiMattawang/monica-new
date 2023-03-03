<div class="d-none d-sm-block">
<ol class="breadcrumb mb-2 ">
     <li class="breadcrumb-item"><a href="{{ route('dashboard') }} ">Dashboard</a></li>
     @if (count($breadcrumb) != 0)
         @foreach ($breadcrumb as $bc)
             {{-- <li class="breadcrumb-item active"> <a href="#">{{ $bc }} </a></li> --}}
             <li class="breadcrumb-item active" aria-current="page">{{ $bc }} </li>
         @endforeach
     @endif
 </ol>
 </div>
 {{-- <div style="padding: 20px 0px 40px 0px !important;"></div> --}}
