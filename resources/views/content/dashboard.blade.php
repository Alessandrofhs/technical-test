@extends('layouts.main')
@section('title', 'Dashboard')
@section('main')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Job Title Report</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <span class="fw-semibold">{{ \Carbon\Carbon::now()->format('l, d F Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <div id="employee-chart" style="height: 400px;"></div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
            Highcharts.chart('employee-chart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Employee Distribution by Job Title'
                },
                xAxis: {
                    categories: @json($jobTitleData->pluck('jobtitle.JobTitleName')), // Nama Job Title
                    title: {
                        text: 'Job Titles'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Number of Employees'
                    }
                },
                series: [{
                    name: 'Employees',
                    data: @json($jobTitleData->pluck('total')) // Jumlah karyawan per Job Title
                }]
            });
        });
    </script>
@endpush
