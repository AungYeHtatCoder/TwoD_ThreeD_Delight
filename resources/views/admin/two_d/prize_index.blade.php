@extends('layouts.admin_app')
@section('styles')
    <style>
        .transparent-btn {
            background: none;
            border: none;
            padding: 0;
            outline: none;
            cursor: pointer;
            box-shadow: none;
            appearance: none;
            /* For some browsers */
        }
    </style>
@endsection
@section('content')
    <div class="row mt-4">
        <div class="col-6">
         <div class="card">
          <div class="card-header">
           <h5>2D Morning Prize Digit Create</h5>
          </div>
          <form action="{{ route('admin.tow-d-win-number.store') }}" class="text-start" method="post">
            @csrf
            <div class="form-group">
             <label for="prize_no">Prize Number</label>
             <input type="text" name="prize_no" id="player_name" class="form-control" placeholder="Player Name">
            </div>
            {{-- <input type="hidden" name="session" value="morning"> --}}

            {{-- button --}}
            <div class="form-group">
             <button type="submit" class="btn btn-primary">Create</button>
            </div>
           </form>
         </div>
            <div class="card">
                <!-- Card header -->
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">2D Prize Digit Create Dashboards</h5>

                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="{{ route('admin.users.create') }}"
                                    class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Create New
                                    User</a>
                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                                    type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-flush" id="twod-search">
                        <thead class="thead-light">
                            <th>#</th>
                            {{-- <th>Lottery ID</th> --}}
                            <th>Prize Number</th>
                            <th>Session</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                         @if($morningData)
                         <tr>
                          <td>{{ $morningData->id }}</td>
                          <td>{{ $morningData->prize_no }}</td>
                          <td>{{ $morningData->session }}</td>
                          <td>{{ $morningData->created_at }}</td>
                         </tr>
                         @else
                         <tr>
                          <td colspan="4" class="text-center">No Data Found</td>
                         </tr>
                         @endif
                  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
         <div class="card">
          <div class="card-header">
           <h5>2D Evening Prize Digit Create</h5>
          </div>
          <div class="card-body">
           {{-- form  --}}
           <form action="{{ route('admin.tow-d-win-number.store') }}" method="post" class="text-start">
            @csrf
            <div class="form-group">
             <label for="prize_no">Prize Number</label>
             <input type="text" name="prize_no" id="player_name" class="form-control" placeholder="Add Prize No">
            </div>
            {{-- <input type="hidden" name="session" value="evening"> --}}
            {{-- button --}}
            <div class="form-group">
             <button type="submit" class="btn btn-primary">Create</button>
            </div>
           </form>
          </div>
         </div>
         <div class="card">
          <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">2D Prize Digit Create Dashboards</h5>

                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="{{ route('admin.users.create') }}"
                                    class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Create New
                                    User</a>
                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                                    type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-flush" id="search">
                        <thead class="thead-light">
                            <th>#</th>
                            {{-- <th>Lottery ID</th> --}}
                            <th>Prize Number</th>
                            <th>Session</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                         @if($eveningData)
                         <tr>
                          <td>{{ $eveningData->id }}</td>
                          <td>{{ $eveningData->prize_no }}</td>
                          <td>{{ $eveningData->session }}</td>
                          <td>{{ $eveningData->created_at }}</td>
                         </tr>
                         @else
                         <tr>
                          <td colspan="4" class="text-center">No Data Found</td>
                         </tr>
                         @endif
                  
                        </tbody>
                    </table>
                </div>
         </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('admin_app/assets/js/plugins/datatables.js') }}"></script>
    {{-- <script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: true
    });
  </script> --}}
    <script>
        if (document.getElementById('twod-search')) {
            const dataTableSearch = new simpleDatatables.DataTable("#twod-search", {
                searchable: true,
                fixedHeight: false,
                perPage: 7
            });

            document.querySelectorAll(".export").forEach(function(el) {
                el.addEventListener("click", function(e) {
                    var type = el.dataset.type;

                    var data = {
                        type: type,
                        filename: "material-" + type,
                    };

                    if (type === "csv") {
                        data.columnDelimiter = "|";
                    }

                    dataTableSearch.export(data);
                });
            });
        };
    </script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    <script>
        if (document.getElementById('search')) {
            const dataTableSearch = new simpleDatatables.DataTable("#search", {
                searchable: true,
                fixedHeight: false,
                perPage: 7
            });

            document.querySelectorAll(".export").forEach(function(el) {
                el.addEventListener("click", function(e) {
                    var type = el.dataset.type;

                    var data = {
                        type: type,
                        filename: "material-" + type,
                    };

                    if (type === "csv") {
                        data.columnDelimiter = "|";
                    }

                    dataTableSearch.export(data);
                });
            });
        };
    </script>
@endsection