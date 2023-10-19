@include('layouts.user_head')
@yield('user_styles')

<body class="presentation-page">
 <!-- Navbar -->
 @include('layouts.user_navbar')

 <section style="padding-top: 100px;">
  <div class="container">
   <div class="row">
    <div class="col-lg-6 col-sm-12 mx-auto">
     <div class="bg-gradient-primary shadow-primary border-radius-lg py-2 pe-1">
      <h4 class="text-white font-weight-bolder text-center mb-2">Fill Money</h4>
     </div>
     <div class="card" id="basic-info">
      <div class="card-header">

      </div>
      <form action="">
       <div class="card-body pt-0">
        <div class="row">
         <label for="title">ဖုန်းနံပါတ်များ</label>
         <div class="input-group mb-2">
          <input type="text" id="title" name="title" class="form-control">
         </div>
        </div>
        <div class="row">
         <h5 class="mt-3">ငွေဖြည့်နည်း</h5>
         <ul class="text-muted ps-4 mb-0 float-start" style="list-style: none;">
          <li>
           <span class="text-sm">၁ : ငွေလွှဲမည့်ဖုန်းနံပါတ်ကို ကူးယူပါ</span>
          </li>
          <li>
           <span class="text-sm">၂: User Name (K pay) မှ ငွေလွှဲပါ</span>
          </li>
          <li>
           <span class="text-sm">၃: ငွေလွှဲပြီးရလာသော လုပ်ငန်းစဉ်အမှတ် နောက်ဆုံး ၆ လုံးအောက်တွင်ဖြည့်ပါ</span>
          </li>
          <li>
           <span class="text-sm">၄: ငွေဖြည့်မည်ကို နှိပ်ပါ</span>
          </li>
         </ul>
        </div>
        <div class="row mt-3">
         <label for="title">လုပ်ငန်းစဉ်အမှတ် နောက်ဆုံး ၆ လုံးကိုဖြည့်ပါ</label>
         <div class="input-group mb-2">
          <input type="text" id="title" name="title" class="form-control">
         </div>
        </div>

        <div class="mt-4 d-flex justify-content-center mb-2">
         <button class="btn bg-gradient-primary btn-sm">ငွေဖြည့်မည်
         </button>
         <a href="{{ url('/user_profile') }}" class="btn bg-gradient-secondary btn-sm ms-3">မလုပ်တော့ပါ
         </a>
        </div>
       </div>
      </form>
     </div>
    </div>
   </div>
  </div>
 </section>

 @include('layouts.user_footer')
 @yield('user_scripts')