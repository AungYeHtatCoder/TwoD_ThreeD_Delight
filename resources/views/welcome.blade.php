@extends('layouts.user_app')

@section('user_styles')
<style>
  .home-parent {
    position: relative;
  }

  .home-banner {
    width: 50%;
    position: absolute;
    left: 100px;
    top: 70px;
    box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px, rgba(0, 0, 0, 0.1) 0px 2px 4px 0px, rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;
    opacity: 0.9;
  }

  @media (min-width: 1200px) {
    .home-banner {
      width: 50%;
      left: 80px;
      top: 70px;
    }
  }

  @media (min-width: 992px) and (max-width: 1200px) {
    .home-banner {
      width: 46%;
      left: 80px;
      top: 30px;
    }

    .home-banner h1 {
      font-size: 27px;
    }
  }

  @media (min-width: 768px) and (max-width: 992px) {
    .home-banner {
      width: 46%;
      left: 25%;
      top: 20%;
    }

    .home-banner h1 {
      font-size: 27px;
    }
  }

  @media (min-width: 500px) and (max-width: 768px) {
    .home-banner {
      width: 60%;
      left: 20%;
      top: 8%;
    }

    .home-banner h1 {
      font-size: 27px;
    }
  }

  @media (min-width: 324px) and (max-width: 500px) {
    .home-parent {
      margin-bottom: 100px;
    }

    .home-banner {
      width: 90%;
      height: 300px;
      left: 5%;
      top: 24%;
    }

    .home-banner h1 {
      font-size: 27px;
    }
  }

  @media (min-width: 280px) and (max-width: 324px) {
    .home-parent {
      margin-bottom: 200px;
    }

    .home-banner {
      width: 90%;
      height: 400px;
      left: 5%;
      top: 24%;
    }

    .home-banner h1 {
      font-size: 27px;
    }
  }
</style>

@endsection

@section('content')
<section class="pt-3" id="count-stats">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 z-index-2 border-radius-xl mt-n10 mx-auto py-3 blur shadow-blur">
        <div class="row">
          <div class="col-md-4 position-relative">
            <div class="p-3 text-center">
              <h4 class="text-gradient text-primary">
                <span id="liveSet">{{ $data['live']['set'] }}</span>
              </h4>
              <h5 class="mt-3">Set Index</h5>
              {{-- <p class="text-sm">From buttons, to inputs, navbars, alerts or cards, you are covered</p> --}}
            </div>
            <hr class="vertical dark">
          </div>
          <div class="col-md-4 position-relative">
            <div class="p-3 text-center">
              <h4 class="text-gradient text-primary"> <span id="liveValue">{{ $data['live']['value'] }}</span></h4>
              <h5 class="mt-3">Value</h5>
              {{-- <p class="text-sm">Mix the sections, change the colors and unleash your creativity</p> --}}
            </div>
            <hr class="vertical dark">
          </div>
          <div class="col-md-4">
            <div class="p-3 text-center">
              <h6 class="text-gradient text-primary">
                <span id="liveTime">{{ $data['live']['time'] }}</span>
              </h6>
              <h5 class="mt-3">RealTime</h5>
              {{-- <p class="text-sm">Save 3-4 weeks of work when you use our pre-made pages for your website</p> --}}
            </div>
            <hr class="vertical dark">
          </div>
          {{-- <div class="col-md-3">
              <div class="p-3 text-center">
                <h6 class="text-gradient text-primary">
                  <span id="liveTime">{{ $data['live']['time'] }}</span>
          </h6>
          <h5 class="mt-3">RealTime</h5>
        </div>
      </div> --}}
    </div>
  </div>
  </div>
  </div>
</section>

<div class="row home-parent" style="margin-top: 100px;">
  <div class="col-lg-6 col-sm-10">
    <div class="card home-banner">
      <div class="card-body">
        <h1 class="text-primary text-gradient">You Can Play</h1>
        <h4>Delight 2D | 3D System</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At quam doloremque cupiditate ducimus facere laudantium neque, cumque provident</p>
        <a href="{{ route('admin.play-twod.index') }}" class="btn bg-gradient-primary btn-xl">PLAY NOW</a>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <img src="user_app/assets/img/curved-images/curved11.jpg" alt="" class="w-100">
  </div>
</div>

<!-- <div class="row align-items-center">
  <div class="col-lg-10 ms-auto">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="info">
          <div class="icon icon-sm">
            {{-- 1 --}}
          </div>
          <h5 class="font-weight-bolder mt-3">Delight 2D
            <span><a href="{{ route('admin.play-twod.index') }}" class="btn btn-primary">Play Two</a></span>
          </h5>
          {{-- add something here --}}
        </div>
      </div>

    </div>

  </div>
  {{-- add more col --}}
</div> -->
@endsection
@section('user_scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    function fetchData() {
      $.ajax({
        url: "/",
        type: "GET",
        dataType: "json",
        success: function(data) {
          // Update live data
          updateLiveData(data.live);

          // Update results
          updateResultsData(data.result);
        }
      });
    }

    function updateLiveData(liveData) {
      // Helper function to update text and possibly animate the update
      function updateAndAnimate(elementId, newValue) {
        const element = $(elementId);
        if (element.text() !== newValue) {
          element.text(newValue).addClass('activeUpdate');
          setTimeout(function() {
            element.removeClass('activeUpdate');
          }, 300);
        }
      }

      updateAndAnimate("#liveSet", liveData.set);
      updateAndAnimate("#liveValue", liveData.value);
      $("#liveTime").text(liveData.time); // Always update time
    }

    function updateResultsData(results) {
      let resultsHtml = '';
      results.forEach(function(result) {
        resultsHtml += `
                    <p>Set: ${result.set}</p>
                    <p>Value: ${result.value}</p>
                    <p>Open Time: ${result.open_time}</p>
                    <hr>
                `;
      });

      $("#resultsData").html(resultsHtml);
    }

    fetchData(); // Initial data fetch
    setInterval(fetchData, 1000); // Fetch data every 3 seconds
  });
</script>
@endsection