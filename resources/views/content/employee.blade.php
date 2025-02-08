@extends('layouts.main')
@section('title', 'employee')
@push('styles')


@endpush
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
                <h2 class="card-title mb-0">Add Employee</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('employee.store') }}" method="POST" class="mt-4 skillForm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="origin" id="origin">
                    <div class="card p-3 mt-4">
                        <div class="email-repeater mb-3 mt-3">
                            <div data-repeater-list="repeater-group">
                                <div data-repeater-item="" class="row mb-3">
                                    <div data-repeater-item="" class="row mb-3">
                                        <!-- Baris 1 -->
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-12">
                                                <label class="mb-1">NIK</label>
                                                <input type="text" class="form-control" placeholder="NIK" name="repeater-group[][nik]" required maxlength="6">
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <label class="mb-1">First Name</label>
                                                <input type="text" class="form-control" placeholder="First Name" name="repeater-group[][firstname]" required maxlength="255">
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <label class="mb-1">Last Name</label>
                                                <input type="text" class="form-control" placeholder="Last Name" name="repeater-group[][lastname]" maxlength="255">
                                            </div>
                                        </div>
                                    
                                        <!-- Baris 2 -->
                                        <div class="row mt-2">
                                            <div class="col-lg-4 col-sm-12">
                                                <label class="mb-1">Department Name</label>
                                                <select class="form-control" name="repeater-group[][departmentid]" required>
                                                    <option value="" selected disabled>Select Department</option>
                                                    @foreach($department as $d)
                                                        <option value="{{ $d->id }}">{{ $d->DepartmentName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <label class="mb-1">Job Title</label>
                                                <select class="form-control" name="repeater-group[][jobtitleid]" required>
                                                    <option value="" selected disabled>Select Job Title</option>
                                                    @foreach($jobtitle as $d)
                                                        <option value="{{ $d->id }}">{{ $d->JobTitleName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <label class="mb-2">Gender</label>
                                                <div class="d-flex">
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="radio" name="repeater-group[][gender]" value="M" required>
                                                        <label class="form-check-label">Male</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="repeater-group[][gender]" value="L" required>
                                                        <label class="form-check-label">Female</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <!-- Baris 3 -->
                                        <div class="row mt-2">
                                            <div class="col-lg-4 col-sm-12">
                                                <label class="mb-1">Place Of Birth</label>
                                                <input type="text" class="form-control" placeholder="Place Of Birth" name="repeater-group[][placeofbirth]" required maxlength="255">
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <label class="mb-1">Date of Birth</label>
                                                <input type="date" class="form-control" name="repeater-group[][dateofbirth]" required>
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <label class="mb-1">Hire Date</label>
                                                <input type="date" class="form-control" name="repeater-group[][hiredate]" required>
                                            </div>
                                        </div>
                                    
                                        <!-- Baris 4 -->
                                        <div class="row mt-2">
                                            <div class="col-lg-4 col-sm-12">
                                                <label class="mb-1">Phone Number</label>
                                                <input type="text" class="form-control" placeholder="Phone Number" name="repeater-group[][phone]" required maxlength="20">
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <label class="mb-1">Email</label>
                                                <input type="email" class="form-control" placeholder="Email" name="repeater-group[][email]" required>
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <label class="mb-1">Address</label>
                                                <textarea class="form-control" placeholder="Enter Address" name="repeater-group[][address]" rows="2" required maxlength="500"></textarea>
                                            </div>
                                        </div>
                                    </div>                                                                       
                                </div>
                            </div>
                            <button type="button" data-repeater-create=""
                                class="btn btn-primary waves-effect waves-light mb-3">
                                <div class="d-flex align-items-center">
                                    Add Employee
                                    <i class="ti ti-circle-plus ms-1 fs-5"></i>
                                </div>
                            </button>
                        </div>
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
                    <div class="col-8">
                        <h4 class="fw-5">
                            Employees
                        </h4>
                    </div>
                    <div class="col-4 text-end d-flex justify-content-end">
                        <button class="btn btn-primary btn-sm px-3 py-1" id="addSkill">
                            <span class="rounded-3 pe-2" id="icon">
                                <i class="ti ti-plus"></i>
                            </span>
                            <span class="d-none d-sm-inline-block">Add Employee</span>
                        </button>
                    </div>
                </div>
            </div>                                    
            <div class="card-body p-3">
                <table class="table text-nowrap align-middle mb-0" id="masterSkill" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">First Name</th>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Department</th>
                            <th class="text-center">Job Title</th>
                            <th class="text-center">Hire date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employee as $d)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $d->FirstName }}</td>
                                <td class="text-center">{{ $d->LastName }}</td>
                                <td class="text-center">{{ $d->Email }}</td>
                                <td class="text-center">{{ $d->jobtitle->department->DepartmentName }}</td>
                                <td class="text-center">{{ $d->jobtitle->JobTitleName }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($d->HireDate)->format('j M Y') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#showModal" data-id="{{ $d->id }}">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#showEditModal" data-id="{{ $d->id }}">
                                            <i class="ti ti-edit"></i>
                                        </button>
                                        <form action="{{ route('employee.delete', $d->id) }}" method="post"
                                            class="delete-button">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="ti ti-x"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Show Details -->
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="showModalLabel">
                        <i class="ti ti-eye"></i> Detail Employee
                    </h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>NIK</th>
                                <td id="showNik"></td>
                            </tr>
                            <tr>
                                <th>First Name</th>
                                <td id="showFirstName"></td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td id="showLastName"></td>
                            </tr>
                            <tr>
                                <th>Departemen</th>
                                <td id="showDepartment"></td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td id="showJobTitle"></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td id="showEmail"></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td id="showGender"></td>
                            </tr>
                            <tr>
                                <th>Place Of Birth</th>
                                <td id="showPlaceOfBirth"></td>
                            </tr>
                            <tr>
                                <th>Date Of Birth</th>
                                <td id="showDateOfBirth"></td>
                            </tr>
                            <tr>
                                <th>Hire Date</th>
                                <td id="showHireDate"></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td id="showAddress"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="ti ti-x"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal confirmation --}}
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-light-warning">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center text-warning">
                        <i class="ti ti-alert-octagon fs-7"></i>
                        <p class="mt-3">
                            Are you sure you want to delete this record?
                        </p>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal edit --}}
    <div class="modal fade" id="showEditModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <input type="hidden" name="id" id="editEmployeeId">
    
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">NIK</label>
                                <input type="text" class="form-control" name="nik" id="editNIK" required maxlength="6">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="firstname" id="editFirstName" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lastname" id="editLastName">
                            </div>
                        </div>
    
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="editEmail" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="editPhone" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Gender</label>
                                <div class="d-flex mt-2">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="gender" value="M" id="editMale">
                                        <label class="form-check-label" for="editMale">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="F" id="editFemale">
                                        <label class="form-check-label" for="editFemale">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="form-label">Department</label>
                                <select class="form-control" name="departmentid" id="editDepartment" required>
                                    @foreach($department as $d)
                                        <option value="{{ $d->id }}">{{ $d->DepartmentName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Job Title</label>
                                <select class="form-control" name="jobtitleid" id="editJobTitle" required>
                                    @foreach($jobtitle as $d)
                                        <option value="{{ $d->id }}">{{ $d->JobTitleName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label">Place Of Birth</label>
                                <input type="text" class="form-control" name="placeofbirth" id="editPlaceOfBirth" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Date Of Birth</label>
                                <input type="date" class="form-control" name="dateofbirth" id="editDateOfBirth" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Hire Date</label>
                                <input type="date" class="form-control" name="hiredate" id="editHireDate" required>
                            </div>
                        </div>   
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="address" id="editAddress" rows="2" required></textarea>
                            </div>
                        </div>
    
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src={{ asset('js/jquery-3.6.3.min.js') }} integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const textareas = document.querySelectorAll("textarea");

            textareas.forEach(textarea => {
                textarea.style.overflow = "hidden"; // Hindari scrollbar
                textarea.style.resize = "none"; // Hindari resize manual
                textarea.addEventListener("input", function () {
                    this.style.height = "auto"; // Reset tinggi dulu
                    this.style.height = this.scrollHeight + "px"; // Sesuaikan tinggi
                });
            });
        });

        $(document).ready(function() {
            $('#addSkill').on('click', function() {
                $("#addSkillCard").toggle();
                $("#icon").html($("#addSkillCard").is(":visible") ? '<i class="ti ti-minus"></i>' :
                    '<i class="ti ti-plus"></i>');
            });

            // Initialize DataTable
            var table = $('#masterSkill').DataTable({
                scrollX: true,
            });
            // Attach click event to your button
            $('.btn-primary').click(function () {
            let employeeId = $(this).data('id');

            $.ajax({
                url: '/employee/modal/' + employeeId,
                method: 'GET',
                success: function (response) {
                    let genderText = response.Gender === "M" ? "Male" : "Female";

                    function formatDate(dateString) {
                        let dateObj = new Date(dateString);
                        let options = { day: 'numeric', month: 'long', year: 'numeric' };
                        return dateObj.toLocaleDateString('id-ID', options);
                    }

                    $('#showNik').text(response.NIK);
                    $('#showFirstName').text(response.FirstName);
                    $('#showLastName').text(response.LastName);
                    $('#showDepartment').text(response.jobtitle.department.DepartmentName);
                    $('#showJobTitle').text(response.jobtitle.JobTitleName);
                    $('#showEmail').text(response.Email);
                    $('#showGender').text(genderText);
                    $('#showPlaceOfBirth').text(response.PlaceOfBirth);
                    $('#showDateOfBirth').text(formatDate(response.DateOfBirth));
                    $('#showHireDate').text(formatDate(response.HireDate));
                    $('#showAddress').text(response.Address);

                    $('#showModal').modal('show');
                }
            });
        });
            $(document).on("click", "[data-target='#showEditModal']", function () {
            let id = $(this).data("id");

            $.ajax({
                url: "{{ route('employee.edit', '') }}/" + id,
                type: "GET",
                success: function (response) {
                    $("#editEmployeeId").val(response.id);
                    $("#editNIK").val(response.NIK);
                    $("#editFirstName").val(response.FirstName);
                    $("#editLastName").val(response.LastName);
                    $("#editEmail").val(response.Email);
                    $("#editPhone").val(response.Phone);
                    $("#editDepartment").val(response.jobtitle.department.id);
                    $("#editJobTitle").val(response.jobtitle.id);
                    $("#editPlaceOfBirth").val(response.PlaceOfBirth);
                    $("#editDateOfBirth").val(response.DateOfBirth);
                    $("#editHireDate").val(response.HireDate);
                    $("#editAddress").val(response.Address);

                    if (response.Gender === "M") {
                        $("#editMale").prop("checked", true);
                    } else {
                        $("#editFemale").prop("checked", true);
                    }

                    $("#showEditModal").modal("show");
                }
            });

            $("#editEmployeeForm").attr("action", "{{ route('employee.update', '') }}/" + id);
        });

            var deleteForm;
            
            $('.delete-button').on('click', function(event) {
                event.preventDefault();

                deleteForm = $(this).closest('form');

                $('#confirmationModal').modal('show');
            });

            $('#confirmDelete').on('click', function() {
                if (deleteForm) {
                    deleteForm.submit();
                }
            });
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const contentWrapper = document.querySelector('.col-12.col-lg-12');
        const sidebarToggle = document.querySelector('#sidebarToggle');
        if (contentWrapper) {
            contentWrapper.classList.add('transition-width');   
            sidebarToggle.addEventListener('click', function () {
                setTimeout(() => {
                    if (document.body.classList.contains('sidebar-collapsed')) {
                        contentWrapper.classList.add('full-width');
                    } else {
                        contentWrapper.classList.remove('full-width');
                    }
                }, 300);
            });
        }
    });
</script>
@endpush
