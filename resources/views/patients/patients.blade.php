@extends('layouts.master')
@section('title')
قائمه المرضي - نظام كلينك لإداره العيادات
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المرضي</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمه المرضي</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif



@if (session()->has('Add'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session()->get('Add')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif


                @if (session()->has('Error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{session()->get('Error')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session()->has('delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('delete') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session()->has('edit'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('edit') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif





				<!-- row -->
				<div class="row">

                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <div class="col-sm-6 col-md-4 col-xl-3">
										<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">إضافه مريض</a>
									</div>
                                    {{-- button --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap" style="text-align: center !important">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0"> # </th>
                                                <th class="border-bottom-0">اسم المريض</th>
                                                <th class="border-bottom-0">رقم الموبايل</th>
                                                <th class="border-bottom-0">العنوان</th>
                                                <th class="border-bottom-0">نوع الزياره</th>
                                                <th class="border-bottom-0">الطبيب</th>
                                                <th class="border-bottom-0">ملاحظات</th>
                                                <th class="border-bottom-0">التاريخ</th>
                                                <th class="border-bottom-0">العمليات</th>
                                            </tr>
                                        </thead>
                                        <?php $i = 0 ?>
                                        <tbody>

                                            @foreach ($patients as $patient)
                                                <?php $i++ ?>

                                                <td>{{$i}}</td>
                                                <td>{{$patient->patient_name}}</td>
                                                <td>{{$patient->patient_number}}</td>
                                                <td>{{$patient->patient_address}}</td>
                                                <td>{{$patient->visit->visit_name}}</td>
                                                <td>{{$patient->doctor->doctor_name}}</td>
                                                <td>{{$patient->note}}</td>
                                                <td>{{$patient->patient_Date}}</td>
                                                <td>

                                                    <a  class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                       data-id="{{ $patient->id }}" data-patient_name="{{ $patient->patient_name }}"
                                                       data-patient_number="{{ $patient->patient_number }}"
                                                       data-patient_address="{{ $patient->patient_address }}"
                                                       data-visit_id="{{ $patient->visit_id }}"
                                                       data-doctor_id="{{ $patient->doctor_id }}"
                                                       data-note="{{ $patient->note }}"
                                                       data-patient_Date="{{ $patient->patient_Date }}"
                                                       data-toggle="modal" href="#exampleModal2"
                                                       title="تعديل"><i class="las la-pen"></i></a>

                                                       <a class="btn btn-sm btn-primary"href="{{url('patients.profile')}}" title="الملف الشخصي"><i class="las la-user"></i></a>
                                                       <a class="btn btn-sm btn-info"href="{{url('invoices.invoices')}}" title="إضافه فاتوره "><i class="las la-book"></i></a>

                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                       data-id="{{ $patient->id }}"
                                                       data-patient_name="{{ $patient->patient_name }}"
                                                         data-toggle="modal"
                                                       href="#modaldemo9" title="حذف"><i class="las la-trash"></i></a>

                                                </td>
                                            </tr>

                                            @endforeach



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- Basic modal -->
                                    <div class="modal" id="modaldemo8">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">إضافه مريض </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('patients.store')}}" method="post">
                                                        @csrf

                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">اسم المريض</label>
                                                            <input type="text" class="form-control" id="patient_name" name="patient_name" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">رقم الموبايل</label>
                                                            <input type="text" class="form-control" id="patient_number" name="patient_number" >
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> العنوان</label>
                                                            <input type="text" class="form-control" id="patient_address" name="patient_address" >
                                                        </div>



                                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">نوع الزياره</label>
                                                        <select name="visit_id" id="visit_id" class="form-control" required>
                                                                <option value="" selected disabled> --نوع الزياره--</option>
                                                            @foreach ($visits as $visit)
                                                                <option value="{{ $visit->id  }}">{{ $visit->visit_name }}</option>
                                                            @endforeach
                                                        </select>

                                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الطبيب</label>
                                                        <select name="doctor_id" id="doctor_id" class="form-control" required>
                                                                <option value="" selected disabled> --حدد الطبيب--</option>
                                                            @foreach ($doctors as $doctor)
                                                                <option value="{{ $doctor->id }}">{{ $doctor->doctor_name }}</option>
                                                            @endforeach
                                                        </select>


                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">ملاحظات</label>
                                                            <input type="text" class="form-control" id="note" name="note">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">التاريخ</label>
                                                            {{-- <input type="date" class="form-control" id="patient_Date" name="patient_Date" value="{{ date('Y-m-d') }}" required> --}}
                                                            <input class="form-control fc-datepicker" id="patient_Date" name="patient_Date" placeholder="DD-MM-YYYY"
                                                                type="date" value="{{ date('d-m-Y') }}" required>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">تاكيد</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    <!-- End Basic modal -->
				</div>

                                                <!-- edit -->
                                                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                               <div class="modal-dialog" role="document">
                                                   <div class="modal-content">
                                                       <div class="modal-header">
                                                           <h5 class="modal-title" id="exampleModalLabel">تعديل المريض</h5>
                                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                               <span aria-hidden="true">&times;</span>
                                                           </button>
                                                       </div>
                                                       <div class="modal-body">

                                                           <form action="patients/update" method="post" autocomplete="off">
                                                               {{method_field('patch')}}
                                                               @csrf
                                                               <div class="form-group">
                                                                   <input type="hidden" name="id" id="id" value="">
                                                                   <label for="recipient-name" class="col-form-label">اسم المريض:</label>
                                                                   <input class="form-control" name="patient_name" id="patient_name" type="text">
                                                               </div>
                                                               <div class="form-group">
                                                                    <input type="hidden" name="id" id="id" value="">
                                                                    <label for="recipient-name" class="col-form-label">رقم الموبايل:</label>
                                                                    <input class="form-control" name="patient_number" id="patient_number" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="hidden" name="id" id="id" value="">
                                                                    <label for="recipient-name" class="col-form-label"> العنوان:</label>
                                                                    <input class="form-control" name="patient_address" id="patient_address" type="text">
                                                                </div>


                                                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">نوع الزياره</label>
                                                                <input type="hidden" name="id" id="id" value="">
                                                                <select name="visit_id" id="visit_id" class="form-control" required>
                                                                        <option value="" selected disabled> --نوع الزياره--</option>
                                                                    @foreach ($visits as $visit)
                                                                        <option value="{{ $visit->id  }}">{{ $visit->visit_name }}</option>
                                                                    @endforeach
                                                                </select>


                                                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الطبيب</label>
                                                                <input type="hidden" name="id" id="id" value="">
                                                                <select name="doctor_id" id="doctor_id" class="form-control" required>
                                                                        <option value="" selected disabled> --حدد الطبيب--</option>
                                                                    @foreach ($doctors as $doctor)
                                                                        <option value="{{ $doctor->id }}">{{ $doctor->doctor_name }}</option>
                                                                    @endforeach
                                                                </select>

                                                               <div class="form-group">
                                                                    <input type="hidden" name="id" id="id" value="">
                                                                    <label for="recipient-name" class="col-form-label"> ملاحظات </label>
                                                                    <input class="form-control" name="note" id="note" type="text">
                                                               </div>
                                                               <div class="form-group">
                                                                    <input type="hidden" name="id" id="id" value="">
                                                                    <label for="recipient-name" class="col-form-label"> التاريخ </label>
                                                                    <input class="form-control" name="patient_Date" id="patient_Date"  type="date" value="{{date('y,m,d')}}">
                                                                </div>
                                                       </div>
                                                       <div class="modal-footer">
                                                           <button type="submit" class="btn btn-primary">تاكيد</button>
                                                           <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                                       </div>
                                                       </form>
                                                   </div>
                                               </div>
                                           </div>

                                       <!-- delete -->
                                       <div class="modal" id="modaldemo9">
                                           <div class="modal-dialog modal-dialog-centered" role="document">
                                               <div class="modal-content modal-content-demo">
                                                   <div class="modal-header">
                                                       <h6 class="modal-title">حذف المريض</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                                                      type="button"><span aria-hidden="true">&times;</span></button>
                                                   </div>
                                                   <form action="patients/destroy" method="post">
                                                       {{method_field('delete')}}
                                                       @csrf
                                                       <div class="modal-body">
                                                           <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                                           <input type="hidden" name="id" id="id" value="">
                                                           <input class="form-control" name="patient_name" id="patient_name" type="text" readonly>
                                                       </div>
                                                       <div class="modal-footer">
                                                           <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                                           <button type="submit" class="btn btn-danger">تاكيد</button>
                                                       </div>
                                               </div>
                                               </form>
                                           </div>
                                       </div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>

<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>

<script src="{{URL::asset('assets/js/modal.js')}}"></script>

    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'dd-mm-yy'
        }).val();
    </script>



<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var patient_name = button.data('patient_name')
        var patient_number = button.data('patient_number')
        var patient_address = button.data('patient_address')
        var visit_id = button.data('visit_id')
        var doctor_id = button.data('doctor_id')
        var note = button.data('note')
        var patient_Date = button.data('patient_Date')

        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #patient_name').val(patient_name);
        modal.find('.modal-body #patient_number').val(patient_number);
        modal.find('.modal-body #patient_address').val(patient_address);
        modal.find('.modal-body #visit_id').val(visit_id);
        modal.find('.modal-body #doctor_id').val(doctor_id);
        modal.find('.modal-body #note').val(note);
        modal.find('.modal-body #patient_Date').val(patient_Date);
    })
</script>

<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var patient_name = button.data('patient_name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #patient_name').val(patient_name);
    })
</script>



@endsection
