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
  