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


        .custom-form-group {
            margin-bottom: 20px;
        }

        .custom-form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .custom-form-group input,
        .custom-form-group select {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #e1e1e1;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
        }

        .custom-form-group input:focus,
        .custom-form-group select:focus {
            border-color: #d33a9e;
            box-shadow: 0 0 5px rgba(211, 58, 158, 0.5);
        }

        .submit-btn {
            background-color: #d33a9e;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
        }

        .submit-btn:hover {
            background-color: #b8328b;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">Role Create Dashboards

                            </h5>
                            <!-- Commented out description for now, can be used later if needed.
                
                -->
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="{{ route('admin.roles.index') }}" class="btn bg-gradient-success btn-sm mb-0 mt-3">
                                    &lt; Back To Role List
                                </a>
                                <p class="text-sm mb-0 mt-3">
                                    A lightweight, extendable, dependency-free javascript HTML table plugin.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
             <div class="container my-auto mt-5">
        <div class="row">
            <div class="col-lg-10 col-md-2 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">New Role Create</h4>

                        </div>
                    </div>
                    <div class="card-body">
                        <form role="form" class="text-start" action="{{ route('admin.roles.store') }}">
                            @csrf
                            <div class="custom-form-group">
                                <label for="title">Role Name</label>
                                <input type="text" id="title" name="title" class="form-control">
                            </div>

                            <div class="custom-form-group">
                                <label for="choices-role">Permission</label>
                                <select class="form-control" name="roles[]" id="choices-roles" multiple>
                                    @foreach ($permissions as $id => $permission)
                                        <option value="{{ $id }}"
                                            {{ in_array($id, old('permissions', [])) || (isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>
                                            {{ $permission }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="custom-form-group">
                                <button type="button" id="submitForm" class="submit-btn my-4 mb-2">Create New Role</button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
   
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>

    <script src="{{ asset('admin_app/assets/js/plugins/choices.min.js') }}"></script>
    <script src="{{ asset('admin_app/assets/js/plugins/quill.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script>
        if (document.getElementById('choices-roles')) {
            var role = document.getElementById('choices-roles');
            const examples = new Choices(role, {
                removeItemButton: true
            });

            examples.setChoices(
                [{
                        value: 'One',
                        label: 'Expired',
                        disabled: true
                    },
                    {
                        value: 'Two',
                        label: 'Out of Role',
                        selected: true
                    }
                ],
                'value',
                'label',
                false,
            );
        }
        // store role
        $(document).ready(function() {
            $('#submitForm').click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.roles.store') }}",
                    data: $('form').serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Role created successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // Reset the form after successful submission
                        $('form')[0].reset();
                    },
                    error: function(error) {
                        console.log(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        });
                    }
                });
            });
        });
    </script>
@endsection
