@extends('layouts.user_app')

@section('user_styles')
    
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
  
    <div class="row align-items-center">
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
    </div>
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
            $("#liveTime").text(liveData.time);  // Always update time
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

        fetchData();  // Initial data fetch
        setInterval(fetchData, 1000);  // Fetch data every 3 seconds
    });
</script>
@endsection
