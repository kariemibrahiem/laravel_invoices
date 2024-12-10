@extends('layouts.master')
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Elements</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Tabs</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
<div class="card mg-b-20" id="tabs-style2">
    <div class="card-body">
        <div class="main-content-label mg-b-5">
            more details about the invoice
        </div>
        {{-- <p class="mg-b-20">It is Very Easy to Customize and it uses in your website apllication.</p> --}}
        <div class="text-wrap">
            <div class="example">
                <div class="panel panel-primary tabs-style-2">
                    <div class=" tab-menu-heading">
                        <div class="tabs-menu1">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs main-nav-line">
                                <li><a href="#tab4" class="nav-link active" data-toggle="tab">details</a></li>
                                <li><a href="#tab5" class="nav-link" data-toggle="tab">payment</a></li>
                                <li><a href="#tab6" class="nav-link" data-toggle="tab">attachments</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body main-content-body-right border">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab4">
                                    {{-- the content of the first tab --}}
                                    <table id="example" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr>
                                             
                                                <th class="wd-15p border-bottom-0">رقم الفاتوره </th>
                                                <th class="wd-25p border-bottom-0">القسم</th>
                                                <th class="wd-25p border-bottom-0">المنتج</th>
                                                <th class="wd-15p border-bottom-0">نسبه الخصم </th>
                                                <th class="wd-15p border-bottom-0">قيمه الفاتوره </th>
                                                <th class="wd-15p border-bottom-0">قيمه 2 الفاتوره </th>
                                                
                                                <th class="wd-25p border-bottom-0">نسبه الضريبه </th>
                                                <th class="wd-25p border-bottom-0">قيمه الضريبه </th>                                                <th class="wd-15p border-bottom-0">تاريخ الفاتوره </th>
                                                <th class="wd-15p border-bottom-0">تاريخ الاستحقاق </th>
                                                <th class="wd-15p border-bottom-0">  القيمه الكليه</th>
                                               
                                            </tr>
                                        </thead>
										<tbody>
                                        
                                          @foreach ($invoices as $invoice)
                                          
                                          <tr>
                                            <th class="wd-15p border-bottom-0">{{$invoice->invoice_number}} </th>
                                            <th class="wd-25p border-bottom-0">{{$invoice->section->section_name}}</th>
                                            <th class="wd-15p border-bottom-0">{{$invoice->product}} </th>
                                            <th class="wd-10p border-bottom-0">{{$invoice->discount}}</th>
                                            <th class="wd-10p border-bottom-0">{{$invoice->total}}</th>
                                            <th class="wd-10p border-bottom-0">{{$invoice->rate_vate}}</th>
                                            <th class="wd-10p border-bottom-0">{{$invoice->value_vate}}</th>
                                            <th class="wd-10p border-bottom-0">{{$invoice->Amount_collection}}</th>
                                            <th class="wd-10p border-bottom-0">{{$invoice->Amount_commision}}</th>
                                            <th class="wd-10p border-bottom-0">{{$invoice->invoice_date}}</th>
                                            <th class="wd-10p border-bottom-0">{{$invoice->due_date}}</th>
                                           
                                       
                                        </tr>
                                              
                                          @endforeach
                                       
										</tbody>
									</table>
                            </div>
                            <div class="tab-pane" id="tab5">
                                 {{-- the content of the first tab --}}
                                 <table id="example" class="table key-buttons text-md-nowrap">
                                    <thead>
                                        <tr>
                                         
                                            <th class="wd-15p border-bottom-0">رقم الفاتوره </th>
                                           
                                         
                                            <th class="wd-15p border-bottom-0"> مدخل الفاتوره </th>

                                            <th class="wd-25p border-bottom-0">طريقه الدفع</th>
                                           
                                            <th class="wd-25p border-bottom-0"> الحاله </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                      @foreach ($invoice_details as $invoice)
                                      
                                      <tr>
                                        <th class="wd-15p border-bottom-0">{{$invoice->invoice_number}} </th>
                                       
                                        <th class="wd-10p border-bottom-0">{{$invoice->user}}</th>
                                        <th class="wd-15p border-bottom-0">{{$invoice->Payment_Date}} </th>
                                       
                                        <th  class="   {{($invoice->Value_Status) == 0 ? "text-danger" : "text-success"}}"> {{$invoice->Value_Status == 0 ? " غير مدفوعه " : "مدفوعه"}}</th>
                                       
                                      
                                    </tr>
                                          
                                      @endforeach
                                   
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab6">
                                  {{-- the content of the third tab --}}
                                  <table id="example" class="table key-buttons text-md-nowrap">
                                      <thead>
                                          <tr>
                                              
                                              <th class="wd-15p border-bottom-0"> file name </th>
                                              <th class="wd-15p border-bottom-0"> entered by  </th>
                                              <th class="wd-25p border-bottom-0"> created at</th>
                                              <th class="wd-25p border-bottom-0"> proccesses</th>                                           
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <h4>add attachment</h4>
                                            @if (Auth::user()->hasRole(["admin"]))
                                                @foreach ($invoices as $invoice)
                                                <form method="POST" class="form m-5" action="{{route("attachment_store")}}" enctype="multipart/form-data">
                                                    @method("POST")
                                                    @csrf
                                                    <input class="form-control" type="file" name="picture">
                                                    <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                                                    <input type="hidden" name="invoice_number" value="{{$invoice->invoice_number}}">
                                                    
                                                    <button class="btn form-control mt-4 btn-primary" type="submit">send file</button>
                                                </form>
                                                @endforeach
                                            @endif
                                            
                                        @foreach ($invoice_attachment as $attachment)
                                      <tr>
                                        <th class="wd-15p border-bottom-0">{{$attachment->file_name}} </th>
                                        <th class="wd-10p border-bottom-0">{{$attachment->Created_by}}</th>
                                        <th class="wd-15p border-bottom-0">{{$attachment->created_at}} </th>
                                        
                                        {{-- <hr>
                                        <h4>add attachment</h4>
                                        <form method="POST" class="form m-5" action="{{route("attachment_store")}}" enctype="multipart/form-data">
                                            @method("POST")
                                            @csrf
                                            <input class="form-control" type="file" name="file_name">
                                            <input type="hidden" name="invoice_id" value="{{$attachment->invoice_id}}">
                                            <input type="hidden" name="invoice_number" value="{{$attachment->invoice_number}}">
        
                                            <button class="btn form-control mt-4 btn-outline-primary" type="submit">send file</button>
                                        </form> --}}
                                    </tr>

                                 
                                          
                                      @endforeach
                                   
                                    </tbody>
                                </table>
                                                                     
                                 
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
<!---Prism Pre code-->
<!---Prism Pre code-->
        </div>
    </div>
</div>
</div>
<!-- /div -->

@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
@endsection