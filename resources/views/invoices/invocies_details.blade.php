@extends('layouts.master')
@section("title" , "invoices")
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

					<!--/div-->

					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">invoices Table</h4>
                                   
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
                                <div class="insert">
                                    <a href="{{route('invoices.create')}}" class="btn btn-primary"> add invoices</a>
                                </div>
								<p class="tx-12 tx-gray-500 mb-2">data from our inovoices Table.. </p>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr>
                                             
                                                <th class="wd-15p border-bottom-0">رقم الفاتوره </th>
                                               
                                                <th class="wd-10p border-bottom-0">المنتج</th>
                                                <th class="wd-25p border-bottom-0">القسم</th>
                                                <th class="wd-25p border-bottom-0">طريقه الدفع</th>
                                               
                                                <th class="wd-25p border-bottom-0"> الحاله </th>
                                                <th class=" w-100 border-bottom-0"> ملاح </th>
                                            </tr>
                                        </thead>
										<tbody>
                                        
                                          @foreach ($invoiceD as $invoice)
                                          
                                          <tr>
                                            <th class="wd-15p border-bottom-0">{{$invoice->invoice_number}} </th>
                                            <th class="wd-10p border-bottom-0">{{$invoice->product}}</th>
                                            <th class="wd-25p border-bottom-0">{{$invoice->invoice->section->section_name}}</th>
                                            <th class="wd-15p border-bottom-0">{{$invoice->Payment_Date}} </th>
                                           
                                            <th  class="   {{($invoice->value_status) == 0 ? "text-danger" : "text-success"}}"> {{$invoice->value_status == 0 ? " غير مدفوعه " : "مدفوعه"}}</th>
                                           
                                            <th class=" w-100" style="display:flex ; flex-wrap: nowrap"> {{$invoice->note != null ? "" : "لا يوجد"}} </th>
                                            <th class="wd-25p border-bottom-0"> </th>
                                        </tr>
                                              
                                          @endforeach
                                       
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->

					<!--div-->
					
				</div>
				<!-- /row -->
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
@endsection