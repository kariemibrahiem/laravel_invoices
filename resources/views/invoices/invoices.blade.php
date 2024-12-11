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
{{-- the notify section --}}
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  الفواتير</span>
            <div class="d-flex flex-column justify-content-center">
                @if(session()->has("success"))
                    <div class="alert text-center alert-success alert-dismissible">
                        {{session()->get("success")}}
                    </div>
                @endif
                @if(session()->has("field"))
                    <div class="alert text-center alert-danger alert-dismissable">
                        {{session()->get("field")}}
                    </div>
                @endif
         
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert text-center alert-danger alert-dismissible">
                            {{$error}}
                        </div>
                        
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    
</div>
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
                                                <th class="wd-15p border-bottom-0">ترتيب الفاتوره </th>
                                                <th class="wd-15p border-bottom-0">رقم الفاتوره </th>
                                              
                                                <th class="wd-25p border-bottom-0">القسم</th>
                                                <th class="wd-10p border-bottom-0">المنتج</th>
                                               
                                                <th class="wd-25p border-bottom-0"> الحاله </th>
                                                <th class="wd-25p border-bottom-0"> ملاحظات </th>
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
                                            <th title="view the invoice detials" onclick="document.getElementById('invoices_details').submit();" style="cursor: pointer" class="wd-25p cursor-pointer border-bottom-0"><a href="{{route("invoices_details" , $invoice->id)}}">{{$invoice->section->section_name}}</a></th>
                                            <th class="wd-10p border-bottom-0">{{$invoice->product}}</th>
                                            {{-- display the invoices details --}}
                                            {{-- <th title="change the invoice status" onclick="document.getElementById('update_status').submit()" style="cursor:pointer" class=" btn btn-sm  {{($invoice->value_status) == 0 ? "text-danger btn-outline-danger" : "text-success btn-outline-success"}}"> <a  href="{{route('update_status' , $invoice->id)}}">{{$invoice->value_status == 0 ? " غير مدفوعه " : "مدفوعه"}}</a></th> --}}
                                            <th title="change the invoice status" onclick="document.getElementById('update_status').submit()" style="cursor:pointer" class=" btn btn-sm  {{($invoice->value_status) == 0 ? "text-danger btn-outline-danger" : "text-success btn-outline-success"}}"> <a href="{{ url("invoices/paymentForm/$invoice->id") }}">{{$invoice->value_status == 0 ? " غير مدفوعه " : "مدفوعه"}}</a></th>
                                            <th class="wd-25p border-bottom-0" > {{$invoice->note != null ? $invoice->note : "لا يوجد"}} </th>
                                            <th class="wd-25p border-bottom-0"> {{$invoice->total}} </th>
                                            <th>
                                                @if (Auth::user()->hasRole(["admin"]))
                                                
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            proccesses
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a  class="dropdown-item btn" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$invoice->id}}">delete</a>
                                                            
                                                            <a class="dropdown-item btn" href="{{route("invoicesEdit.edit" , $invoice->id)}}">edit</a>
                                                            <a class="dropdown-item btn" href="{{route("printInvoice" , $invoice->id)}}">print</a>
                                                     
                                                        </div>
                                                    </div>
                                                @endif
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

<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
</script>
@endsection



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">are you shure to delete ?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
            <div class="col-6">

                <form action="{{route('invoicesDelete.destroy')}}">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id">
                    </div>
                    <button class="btn btn-danger" type="submit"> archive </button>
                </form>
            </div>
            @if (Auth::user()->hasRole(["super_admin"]))
                <div class="col-6">
                
                    <form action="{{route('invoicesForceDelete.forceDelete')}}">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id">
                            </div>
                            <button class="btn btn-danger" type="submit"> force delete </button>
                    </form>
                </div>
            @endif
            </div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>