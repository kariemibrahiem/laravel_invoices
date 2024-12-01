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
                                    {{-- @if (session()->has("field"))
                                        <div class="alert">
                                            <h1>{{session()->get("field")}}</h1>
                                        </div>
                                        
                                    @endif
                                    @if (session()->has()"success")
                                        <div class="alert">
                                            <h1>{{session()->get("success")}}</h1>
                                        </div>
                                        
                                    @endif --}}
                                    @if (session()->has("success"))
                                        <div class="alert alert-success text-center">
                                            {{session()->get("success")}}
                                        </div>
                                    @endif
                                    @if (session()->has("fail"))
                                        <div class="alert text-center alert-danger alert-dismissable">
                                            {{session()->get("fail")}}
                                        </div>
                                    @endif
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
                                                <th class="wd-15p border-bottom-0">ترتيب الفاتوره </th>
                                                <th class="wd-15p border-bottom-0">رقم الفاتوره </th>
                                              
                                                <th class="wd-10p border-bottom-0">المنتج</th>
                                                <th class="wd-25p border-bottom-0">القسم</th>
                                               
                                                <th class="wd-25p border-bottom-0"> الحاله </th>
                                                <th class="wd-25p border-bottom-0"> الاجمالي </th>
                                            </tr>
                                        </thead>
										<tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                          @foreach ($invoices as $invoice)
                                          @php
                                              $i++;
                                          @endphp
                                          <tr>
                                            <th class="wd-15p border-bottom-0">{{$i}} </th>
                                            <th class="wd-15p border-bottom-0">{{$invoice->invoice_number}} </th>
                                            <th class="wd-10p border-bottom-0">{{$invoice->product}}</th>
                                            {{-- display the invoices details --}}
                                            <th title="view the invoice detials" onclick="document.getElementById('invoices_details').submit();" style="cursor: pointer" class="wd-25p cursor-pointer border-bottom-0"><a href="{{route("invoices_details" , $invoice->id)}}">{{$invoice->section->section_name}}</a></th>
                                            <th title="change the invoice status" onclick="document.getElementById('update_status').submit()" style="cursor:pointer" class=" btn btn-sm  {{($invoice->value_status) == 0 ? "text-danger btn-outline-danger" : "text-success btn-outline-success"}}"> <a  href="{{route('update_status' , $invoice->id)}}">{{$invoice->value_status == 0 ? " غير مدفوعه " : "مدفوعه"}}</a></th>
                                            <th class="wd-25p border-bottom-0" > {{$invoice->note != null ? $invoice->note : "لا يوجد"}} </th>
                                            <th class="wd-25p border-bottom-0"> </th>
                                            <th class="wd-25p border-bottom-0"> {{$invoice->total}} </th>
                                            <th>
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      proccesses
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                      <a class="dropdown-item" href="{{route("invoicesDelete.destroy" , $invoice->id)}}">delete</a>
                                                      <a class="dropdown-item" href="{{route("invoicesEdit.edit" , $invoice->id)}}">edit</a>
                                                      
                                                      
                                                    </div>
                                                  </div>
                                            </th>
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