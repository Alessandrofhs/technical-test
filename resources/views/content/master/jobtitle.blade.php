@extends('layouts.main')
@section('title', 'jobtitles')

@section('main')
    <div class="col-12 col-lg-12">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success - </strong> {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Error - </strong> {{ session('error') }}
            </div>
        @endif
        <div class="card shadow" id="addSkillCard" style="display: none">
            <div class="border-bottom title-part-padding">
                <h3 class="card-title mb-0">Add Jobtitles</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('master.jobtitle.store') }}" method="POST" class="mt-4 skillForm">
                    @csrf
                    <div class="email-repeater mb-3">
                        <div data-repeater-list="repeater-group">
                            <div data-repeater-item="" class="row mb-3">
                                <div class="col-lg-5 col-sm-12">
                                    <label class="mb-1">jobtitle Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name" required>
                                </div>
                                <div class="col-lg-5 col-sm-12">
                                    <label class="mb-1">Department Name</label>
                                    <select class="form-control" name="departmentid">
                                        <option value="" selected disabled>Select Department</option>
                                        @foreach($department as $d)
                                            <option value="{{ $d->id }}">{{ $d->DepartmentName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2 col-sm-12 d-flex align-items-end">
                                    <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light"
                                        type="button">
                                        <i class="ti ti-circle-x fs-5"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="button" data-repeater-create=""
                            class="btn btn-primary waves-effect waves-light mb-3">
                            <div class="d-flex align-items-center">
                                Add jobtitle
                                <i class="ti ti-circle-plus ms-1 fs-5"></i>
                            </div>
                        </button>
                    </div>
                    <div class="mb-3">
                        <button
                            class="btn rounded-pill px-4 btn-success text-light font-weight-medium waves-effect waves-light"
                            type="submit">
                            <i class="ti ti-send fs-5"></i>
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header pt-4" style="background-color: white !important">
                <div class="row">
                    <div class="col-9">
                        <h4 class="fw-5">Registered jobtitles</h4>
                    </div>
                    <div class="col-3 text-end">
                        <button class="btn btn-primary px-4 py-2" id="addSkill">
                            <span class="rounded-3 pe-2" id="icon">
                                <i class="ti ti-plus"></i>
                            </span>
                            <span class="d-none d-sm-inline-block">Add jobtitles</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <table class="table text-nowrap align-middle mb-0" id="masterSkill" style="width:100%">
                    <thead>
                        <tr>
                            <th>Jobtitle Name</th>
                            <th>Department</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Job Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
    
                        <input type="hidden" name="id" id="editJobTitleId">
    
                        <div class="mb-3">
                            <label for="editjobtitles" class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="editjobtitles" name="name" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="editDepartment" class="form-label">Department</label>
                            <select class="form-control" id="editDepartment" name="departmentid">
                                <option value="" selected disabled>Select Department</option>
                                @foreach($department as $d)
                                    <option value="{{ $d->id }}">{{ $d->DepartmentName }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery-3.6.3.min.js') }}" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
        crossorigin="anonymous"></script>
    <script>
        $('#addSkill').on('click', function() {
            $("#addSkillCard").toggle();
            $("#icon").html($("#addSkillCard").is(":visible") ? '<i class="ti ti-minus"></i>' :
                '<i class="ti ti-plus"></i>');
        });

        $(document).ready(function() {
            var table = $('#masterSkill').DataTable();

            function fetchData() {
                $.ajax({
                    url: '{{ route('master.jobtitle.data') }}',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        table.clear().draw();
                        $.each(data, function(index, item) {
                            table.row.add([
                                item.JobTitleName ? item.JobTitleName : '-',
                                item.department.DepartmentName,
                                '<div class="text-center">' +
                                '<button class="btn btn-icon btn-warning edit me-2" data-id="' +
                                item.id + '"><i class="ti ti-edit"></i></button>' +
                                '<button class="btn btn-icon btn-danger delete" data-id="' +
                                item.id + '"><i class="ti ti-trash"></i></button>' +
                                '</div>'
                            ]).draw();
                        });
                    }
                });
            }

            fetchData();

            $(document).on('click', '.edit', function() {
                let id = $(this).data('id');

                $.ajax({
                    url: '/master/jobtitle/edit/' + id,
                    method: 'GET',
                    success: function(response) {
                        $('#editJobTitleId').val(response.id);
                        $('#editjobtitles').val(response.JobTitleName);
                        $('#editDepartment').val(response.DepartmentID);

                        $('#editForm').attr('action', '/master/jobtitle/update/' + id);

                        $('#editModal').modal('show');
                    }
                });
            });


            // Delete data
            $('#masterSkill').on('click', '.delete', function() {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: '{{ route('master.jobtitle.delete', '') }}/' + id,
                        method: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                alert(response.success);
                                fetchData();
                            } else {
                                alert('Error: ' + response.error);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('An error occurred: ' + error);
                        }
                    });
                }
            });
        });
    </script>
@endpush
