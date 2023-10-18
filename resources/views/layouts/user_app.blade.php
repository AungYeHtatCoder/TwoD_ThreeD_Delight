@include('layouts.user_head')
@yield('user_styles')

<body class="presentation-page">
 <!-- Navbar -->
 @include('layouts.user_navbar')
 @include('layouts.user_header')
 {{-- @include('layouts.show_user_count') --}}
 <section>
  <div class="container">
   @yield('content')
  </div>
 </section>
 <!-- @include('layouts.huge') -->
 <!-- -------- START Content Presentation Docs ------- -->
 <!-- @include('layouts.docs') -->
 {{-- add new --}}
 <!-- -------- END Content Presentation Docs ------- -->
 <!-- @include('layouts.user_pay_section')
  @include('layouts.user_feedback_section')
  @include('layouts.user_like_section') -->
 <!-- START Section Content W/ 2 images aside of icon title description -->
 <!-- @include('layouts.user_thank_section') -->
 <!-- END Section Content -->
 <!-- -------   START PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->
 <!-- @include('layouts.user_social_section') -->
 <!-- -------   END PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->
 @include('layouts.user_footer')
 @yield('user_scripts')