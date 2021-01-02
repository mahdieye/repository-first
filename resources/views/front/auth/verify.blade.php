@extends('front.index')
@section('content')

  <section id="intro2" class="clearfix"></section>

 <main class="container main2">

     <nav aria-label="breadcrumb ">
         <ol class="breadcrumb bgcolor">
             <li class="breadcrumb-item"><a href="#">خانه</a></li>
             <li class="breadcrumb-item active" aria-current="page">فعال سازی حساب کاربری</li>
         </ol>
     </nav>


     @include('front.messages')

     <div class="d-flex justify-content-center">

        <div class="card">
            برای فعال سازی حساب کاربری خود روی این دکمه کلیک کنید تا ایمیل فعال سازی برای شما ارسال شود
           <hr>
            @if(session('resent'))
                <div class="alert alert-success">ایمیل برای فعالسازی حساب کاربری شما ارسال شد.ایمیل خود را بررسی و روی لینک فعال سازی حساب کاربری کلیک نمایید.</div>
                @endif
            <form action="{{route('verification.resend')}}" method="POST">
             @csrf
            <button>ارسال ایمیل فعال سازی</button>
            </form>
        </div>

      </div>

  </main>

 @endsection

