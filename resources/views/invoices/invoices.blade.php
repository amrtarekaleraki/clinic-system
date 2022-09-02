@extends('layouts.master')
@section('title')
قائمه الفواتير - نظام كلينك لإداره العيادات
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
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمه الفواتير</span>
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
										<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">إضافه فاتوره</a>
									</div>
                                    {{-- button --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length="50" style="text-align: center !important">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0"> # </th>
                                                <th class="border-bottom-0">اسم المريض</th>
                                                <th class="border-bottom-0"> نوع المرض</th>
                                                <th class="border-bottom-0">العدد</th>
                                                <th class="border-bottom-0"> الخصم</th>
                                                <th class="border-bottom-0">الطبيب</th>
                                                <th class="border-bottom-0">الحاله</th>
                                                <th class="border-bottom-0">التاريخ</th>
                                                <th class="border-bottom-0">ملاحظات</th>
                                                <th class="border-bottom-0">العمليات</th>
                                            </tr>
                                        </thead>
                                        <?php $i = 0 ?>
                                        <tbody>

                                            @foreach ($invoices as $invoice)
                                                <?php $i++ ?>

                                                <td>{{$i}}</td>
                                                <td>{{$invoice->patient->patient_name}}</td>
                                                <td>{{$invoice->disease->disease_name}}</td>
                                                <td>{{$invoice->disease_number}}</td>
                                                <td>{{$invoice->Discount}}</td>
                                                <td>{{$invoice->doctor->doctor_name}}</td>
                                                <td>{{$invoice->Status}}</td>
                                                <td>{{$invoice->invoice_Date}}</td>
                                                <td>{{$invoice->note}}</td>
                                                <td>

                                                    <button class="btn btn-success btn-sm"
                                                        data-id="{{ $invoice->id }}"
                                                        data-patient_name="{{ $invoice->patient->patient_name }}"
                                                        data-disease_name="{{ $invoice->disease->disease_name }}"
                                                        data-disease_number="{{ $invoice->disease_number }}"
                                                        data-Discount="{{ $invoice->Discount }}"
                                                        data-doctor_name="{{ $invoice->doctor->doctor_name }}"
                                                        data-Status="{{ $invoice->Status }}"
                                                        data-invoice_Date="{{ $invoice->invoice_Date }}"
                                                        data-note="{{ $invoice->note }}"
                                                        data-toggle="modal"
                                                        data-target="#edit_Product">تعديل</button>

                                                    <a class="btn btn-sm btn-primary" href="Print_invoice/{{ $invoice->id }}" title="طباعة الفاتورة"><i class="fas fa-print"></i></a>

                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                       data-id="{{ $invoice->id }}"
                                                       {{-- data-patient_name="{{ $invoice->patient->patient_name }}" --}}
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
                                                    <h6 class="modal-title">إضافه فاتوره </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('invoices.store')}}" method="post">
                                                        @csrf

                                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">المريض</label>
                                                        <select name="patient_id" id="patient_id" class="form-control" required>
                                                                <option value="" selected disabled> --حدد المريض--</option>
                                                            @foreach ($patients as $patient)
                                                                <option value="{{ $patient->id }}">{{ $patient->patient_name }}</option>
                                                            @endforeach
                                                        </select>

                                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">نوع المرض</label>
                                                        <select name="disea_id" id="disea_id" class="form-control" required>
                                                                <option value="" selected disabled> --نوع المرض--</option>
                                                            @foreach ($diseases as $disease)
                                                                <option value="{{ $disease->id }}">{{ $disease->disease_name }}</option>
                                                            @endforeach
                                                        </select>

                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> العدد</label>
                                                            <input type="text" class="form-control" id="disease_number" name="disease_number" required>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"> الخصم</label>
                                                            <input type="text" class="form-control" id="Discount" name="Discount">
                                                        </div>

                                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الطبيب</label>
                                                        <select name="doctor_id" id="doctor_id" class="form-control" required>
                                                                <option value="" selected disabled> --حدد الطبيب--</option>
                                                            @foreach ($doctors as $doctor)
                                                                <option value="{{ $doctor->id }}">{{ $doctor->doctor_name }}</option>
                                                            @endforeach
                                                        </select>


                                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الحاله</label>
                                                        <select name="Status" id="Status" class="form-control" required>
                                                                <option value="" selected disabled> -- الحاله--</option>
                                                            {{-- @foreach ($doctors as $doctor) --}}
                                                                <option value="خالص">خالص</option>
                                                                <option value="متبقي">متبقي</option>
                                                            {{-- @endforeach --}}
                                                        </select>


                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">التاريخ</label>
                                                            <input type="date" class="form-control" id="invoice_Date" name="invoice_Date" value="{{ date('Y-m-d') }}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">ملاحظات</label>
                                                            <input type="text" class="form-control" id="note" name="note">
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


                     <!-- edit -->
                            <div class="modal fade" id="edit_Product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل فاتوره</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action='invoices/update' method="post">
                                        {{ method_field('patch') }}
                                        {{ csrf_field() }}
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <input type="hidden" name="id" id="id" value="">
                                                <label for="title">اسم المريض :</label>
                                                <select name="patient_name" id="patient_name" class="form-control" required>
                                                    <option value="" selected disabled> --حدد المريض--</option>
                                                @foreach ($patients as $patient)
                                                    <option>{{ $patient->patient_name }}</option>
                                                @endforeach
                                            </select>
                                            </div>

                                            <div class="form-group">
                                                <input type="hidden" name="id" id="id" value="">
                                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">نوع المرض</label>
                                                <select name="disease_name" id="disease_name" class="form-control" required>
                                                    <option value="" selected disabled> --نوع المرض--</option>
                                                    @foreach ($diseases as $disease)
                                                        <option>{{ $disease->disease_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <input type="hidden" name="id" id="id" value="">
                                                <label for="des">العدد :</label>
                                                <input type="text" class="form-control" id="disease_number" name="disease_number" required>
                                            </div>

                                            <div class="form-group">
                                                <input type="hidden" name="id" id="id" value="">
                                                <label for="des">الخصم :</label>
                                                <input type="text" class="form-control" name="Discount" id="Discount">
                                            </div>

                                            <div class="form-group">
                                                <input type="hidden" name="id" id="id" value="">
                                                <label for="des">الطبيب :</label>
                                                <select name="doctor_name" id="doctor_name" class="form-control" required>
                                                    <option value="" selected disabled> --حدد الطبيب--</option>
                                                @foreach ($doctors as $doctor)
                                                    <option>{{ $doctor->doctor_name }}</option>
                                                @endforeach
                                            </select>
                                            </div>

                                            <div class="form-group">
                                                <input type="hidden" name="id" id="id" value="">
                                                <label for="des">الحاله :</label>
                                                    <select name="Status" id="Status" class="form-control" required>
                                                        <option value="" selected disabled> -- الحاله--</option>
                                                    {{-- @foreach ($invoices as $invoice) --}}
                                                        <option value="خالص">خالص</option>
                                                        <option value="متبقي">متبقي</option>
                                                    {{-- @endforeach --}}
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <input type="hidden" name="id" id="id" value="">
                                                <label for="exampleFormControlTextarea1">التاريخ</label>
                                                <input type="date" class="form-control" id="invoice_Date" name="invoice_Date" value="date()" required>
                                            </div>

                                            <div class="form-group">
                                                <input type="hidden" name="id" id="id" value="">
                                                <label for="exampleFormControlTextarea1">ملاحظات</label>
                                                <input type="text" class="form-control" id="note" name="note">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">تعديل البيانات</button>
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
                                        <h6 class="modal-title">حذف الفاتوره</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                                       type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form action="patients/destroy" method="post">
                                        {{method_field('delete')}}
                                        @csrf
                                        <div class="modal-body">
                                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                            <input type="hidden" name="id" id="id" value="">
                                            {{-- <input class="form-control" name="patient_name" id="patient_name" type="text" readonly> --}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                            <button type="submit" class="btn btn-danger">تاكيد</button>
                                        </div>
                                </div>
                                </form>
                            </div>
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

    {{-- <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'dd-mm-yy'
        }).val();
    </script> --}}






    <script>
        $('#edit_Product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var patient_name = button.data('patient_name')
            var disease_name = button.data('disease_name')
            var disease_number = button.data('disease_number')
            var Discount = button.data('Discount')
            var doctor_name = button.data('doctor_name')
            var Status = button.data('Status')
            var invoice_Date = button.data('invoice_Date')
            var note = button.data('note')

            var modal = $(this)

            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #patient_name').val(patient_name);
            modal.find('.modal-body #disease_name').val(disease_name);
            modal.find('.modal-body #disease_number').val(disease_number);
            modal.find('.modal-body #Discount').val(Discount);
            modal.find('.modal-body #doctor_name').val(doctor_name);
            modal.find('.modal-body #Status').val(Status);
            modal.find('.modal-body #invoice_Date').val(invoice_Date);
            modal.find('.modal-body #note').val(note);

        })


        $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        // var patient_name = button.data('patient_name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        // modal.find('.modal-body #patient_name').val(patient_name);
    })

    </script>




@endsection
