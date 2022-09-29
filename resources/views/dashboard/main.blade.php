@extends('app')

@section('plugins.Chartjs', true)


@section('content')

    @section('content_header')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ol>
        </nav>
    @stop

    @section('content')

        @include('dashboard.boxinfo', [
            'enable_staff' => $enable_staff ,
            'disabled_staff' => $disabled_staff ,
        ])

        <div class="row">
            @include('dashboard.charts.staff.pie')
            @include('dashboard.charts.staff.bar')
        </div>
        
        
        @section('js')
            
            <script>

                var ctx_staff_enable = document.getElementById("staff_enable").getContext('2d');
                var ctx_staff_dosabled = document.getElementById("staff_disabled").getContext('2d');
                
                var ctx_staff_by_department = document.getElementById("staff_by_department"); 
                var ctx_staff_reasons_to_leave_the_work = document.getElementById("char_staff_reasons_to_leave_the_work"); 
                var ctx_char_rotation_by_supervisor = document.getElementById("char_rotation_by_supervisor"); 
                                                
                var ctx_char_rotation_by_companies = document.getElementById("char_rotation_by_companies"); 
                var ctx_char_rotation_by_branch = document.getElementById("char_rotation_by_branch"); 
                var ctx_char_rotation_by_jop_position = document.getElementById("char_rotation_by_jop_position"); 
                
                let char_bar_enable =  {!! json_encode($char_bar_enable) !!}
                let char_bar_disabled =  {!! json_encode($char_bar_disabled) !!}
               
                let char_staff_by_department_enable =  {!! json_encode($char_staff_by_department_enable) !!}
                // chart rotation reasons
                let char_staff_reasons_to_leave_the_work =  {!! json_encode($char_staff_reasons_to_leave_the_work) !!}
                // chart supervisor
                let char_rotation_by_supervisor =  {!! json_encode($char_rotation_by_supervisor) !!}
                // chart rotation by company
                let char_rotation_by_companies =  {!! json_encode($char_rotation_by_companies) !!}
                // chart rotation by branch
                let char_rotation_by_branch =  {!! json_encode($char_rotation_by_branch) !!}
                // chart rotation by position
                let char_rotation_by_jop_position =  {!! json_encode($char_rotation_by_jop_position) !!}
                
                 // CHARST
                 var ChartStaffByDepartment = new Chart(ctx_char_rotation_by_supervisor, {
                    type: 'doughnut',
                    data: {
                        labels: char_rotation_by_supervisor.map((i)=>{ return `${i.name} : ${i.data}` }),
                        datasets: [{
                        //label: 'Bajas ',
                        data: char_rotation_by_supervisor.map((i)=>{ return i.data }) ,
                        backgroundColor: char_rotation_by_supervisor.map((val,index)=>{ return (index%2==0) ? 'rgba(67, 160, 71, 0.2)':'rgba(21, 101, 192, 0.2)'}),
                        borderColor: char_rotation_by_supervisor.map((val,index)=>{ return (index%2==0) ? 'rgba(67, 160, 71, 1)':'rgba(21, 101, 192, 1)'}),
                        borderWidth: 1
                        }]
                    },
                    options: {
                        //cutoutPercentage: 40,
                        responsive: true,
                        legend: {
                            position: 'right'
                        }

                    }
                });

                 // chart rotation by company
                 var ChartRotationCompany = new Chart(ctx_char_rotation_by_companies, {
                    type: 'doughnut',
                    data: {
                        labels: char_rotation_by_companies.map((i)=>{ return `${i.name} : ${i.data}` }),
                        datasets: [{
                        //label: 'Bajas ',
                        data: char_rotation_by_companies.map((i)=>{ return i.data }) ,
                        backgroundColor: char_rotation_by_companies.map((val,index)=>{ return (index%2==0) ? 'rgba(67, 160, 71, 0.2)':'rgba(21, 101, 192, 0.2)'}),
                        borderColor: char_rotation_by_companies.map((val,index)=>{ return (index%2==0) ? 'rgba(67, 160, 71, 1)':'rgba(21, 101, 192, 1)'}),
                        borderWidth: 1
                        }]
                    },
                    options: {
                        //cutoutPercentage: 40,
                        responsive: true,
                        legend: {
                            position: 'top'
                        }

                    }
                });

                // chart rotation by company
                var ChartRotationbranch = new Chart(ctx_char_rotation_by_branch, {
                    type: 'doughnut',
                    data: {
                        labels: char_rotation_by_branch.map((i)=>{ return `${i.name} : ${i.data}` }),
                        datasets: [{
                        //label: 'Bajas ',
                        data: char_rotation_by_branch.map((i)=>{ return i.data }) ,
                        backgroundColor: char_rotation_by_branch.map((val,index)=>{ return (index%2==0) ? 'rgba(67, 160, 71, 0.2)':'rgba(21, 101, 192, 0.2)'}),
                        borderColor: char_rotation_by_branch.map((val,index)=>{ return (index%2==0) ? 'rgba(67, 160, 71, 1)':'rgba(21, 101, 192, 1)'}),
                        borderWidth: 1
                        }]
                    },
                    options: {
                        //cutoutPercentage: 40,
                        responsive: true,
                        legend: {
                            position: 'top'
                        }

                    }
                });
                
                
                let months = [];
                let data_enable = [];   
                let data_enable_bg = [];
                let data_enable_border = [];
                char_bar_enable.map( (val) => {
                    //console.log(val.month)
                    months.push(`${val.year} ${val.month}`);
                    data_enable.push(val.data);
                    data_enable_bg.push('rgba(67, 160, 71, 0.2)')
                    data_enable_border.push('rgba(67, 160, 71,1)')
                } )

                let months_disabled = [];
                let data_disabled = [];   
                let data_disabled_bg = [];
                let data_disabled_border = [];
                char_bar_disabled.map( (val) => {
                    //console.log(val.month)
                    months_disabled.push(`${val.year} ${val.month}`);
                    data_disabled.push(val.data);
                    data_disabled_bg.push('rgba(211, 47, 47, 0.2)')
                    data_disabled_border.push('rgba(211, 47, 47,1)')
                } )
                 
                // CHARST
                var ChartBarStaffEnable = new Chart(ctx_staff_enable, {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Personal dado de alta',
                            data: data_enable ,
                            backgroundColor: data_enable_bg ,
                            borderColor: data_enable_border,
                            borderWidth: 1
                        }]

                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true ,
                                    stepSize: 1
                                }
                            }]
                        }
                    }
                });

                var ChartBarStaffDisabled = new Chart(ctx_staff_dosabled, {
                    type: 'bar',
                    data: {
                        labels: months_disabled,
                        datasets: [{
                            label: 'Personal dado de baja',
                            data: data_disabled ,
                            backgroundColor: data_disabled_bg ,
                            borderColor: data_disabled_border,
                            borderWidth: 1
                        }]

                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true ,
                                    stepSize: 1
                                }
                            }]
                        }
                    }
                });

                var ChartStaffByDepartment = new Chart(staff_by_department, {
                    type: 'doughnut',
                    data: {
                        labels: char_staff_by_department_enable.map((i)=>{ return `${i.department} : ${i.data}` }),
                        datasets: [{
                        label: 'Personal Activo por area',
                        data: char_staff_by_department_enable.map((i)=>{ return i.data }) ,
                        backgroundColor: char_staff_by_department_enable.map((val,index)=>{ return (index%2==0) ? 'rgba(67, 160, 71, 0.2)':'rgba(21, 101, 192, 0.2)'}),
                        borderColor: char_staff_by_department_enable.map((val,index)=>{ return (index%2==0) ? 'rgba(67, 160, 71, 1)':'rgba(21, 101, 192, 1)'}),
                        borderWidth: 1
                        }]
                    },
                    options: {
                        //cutoutPercentage: 40,
                        responsive: true,
                        legend: {
                            position: 'right'
                        }

                    }
                });


                var ChartStaffByDepartment = new Chart(ctx_staff_reasons_to_leave_the_work, {
                    type: 'doughnut',
                    data: {
                        labels: char_staff_reasons_to_leave_the_work.map((i)=>{ return `${i.reason} : ${i.data}` }),
                        datasets: [{
                        label: 'Personal Activo por area',
                        data: char_staff_reasons_to_leave_the_work.map((i)=>{ return i.data }) ,
                        backgroundColor: char_staff_reasons_to_leave_the_work.map((val,index)=>{ return (index%2==0) ? 'rgba(67, 160, 71, 0.2)':'rgba(21, 101, 192, 0.2)'}),
                        borderColor: char_staff_reasons_to_leave_the_work.map((val,index)=>{ return (index%2==0) ? 'rgba(67, 160, 71, 1)':'rgba(21, 101, 192, 1)'}),
                        borderWidth: 1
                        }]
                    },
                    options: {
                        //cutoutPercentage: 40,
                        responsive: true,
                        legend: {
                            position: 'right'
                        }

                    }
                });

                // CHARST
                var ChartRotationJopPosition = new Chart(ctx_char_rotation_by_jop_position, {                   
                    type: 'bar',
                    type: 'horizontalBar',
                    data: {
                        labels: char_rotation_by_jop_position.map((i)=>{ return `${i.name}` }),
                        datasets: [{
                            label: '',
                            data: char_rotation_by_jop_position.map((i)=>{ return i.data }) ,
                            backgroundColor: char_rotation_by_jop_position.map((val,index)=>{ return (index%2==0) ? 'rgba(67, 160, 71, 0.2)':'rgba(21, 101, 192, 0.2)'}) ,
                            borderColor: char_rotation_by_jop_position.map((val,index)=>{ return (index%2==0) ? 'rgba(67, 160, 71, 1)':'rgba(21, 101, 192, 1)'}) ,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true ,
                                    stepSize: 1
                                }
                            }]
                        }
                    }
                });
                    
            </script>  
        @endsection

        
    @stop

@stop
