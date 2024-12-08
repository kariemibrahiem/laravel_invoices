@extends('layouts.master')

@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }

    </style>
@endsection
@section('title')
    معاينه طباعة الفاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    معاينة طباعة الفاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/   تحصيل الفواتير </span>
						</div>
					</div>
				
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-md-12 col-xl-12">
						<div class=" main-content-body-invoice" id="print"> 
							<div class="card card-invoice">
								<div class="card-body">
									<div class="invoice-header">
										<h1 class="invoice-title">تحصيل فاتوره</h1>
									
									</div>
									<div class="row mg-t-20">
										<div class="col-md">
											<label class="tx-gray-600">Billed To</label>
											<div class="billed-to">
												<h6>{{$invoice->user}}</h6>
												<p>{{Auth::user()->id}}<br>
                                                    {{Auth::user()->email}}
											</div>
										</div>
										<div class="col-md">
											<label class="tx-gray-600">Invoice Information</label>
											<p class="invoice-info-row"><span>Invoice No</span> <span>{{$invoice->invoice_number}}</span></p>
											<p class="invoice-info-row"><span>Issue Date:</span> <span>{{$invoice->invoice_date}}</span></p>
											<p class="invoice-info-row"><span>Due Date:</span> <span>{{$invoice->due_date}}</span></p>
											<p class="invoice-info-row"><span>section name:</span> <span>{{$invoice->section->section_name}}</span></p>
										</div>
									</div>
									<div class="table-responsive mg-t-40">
                                        <table class="table table-invoice border text-md-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="wd-20p">#</th>
                                                    <th class="wd-40p">المنتج</th>
                                                    <th class="tx-center">مبلغ التحصيل</th>
                                                    <th class="tx-right">مبلغ العمولة</th>
                                                    <th class="tx-right">الاجمالي</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td class="tx-12">{{ $invoice->product }}</td>
                                                    <td class="tx-center">{{ number_format($invoice->Amount_collection, 2) }}</td>
                                                    <td class="tx-right">{{ number_format($invoice->Amount_commision, 2) }}</td>
                                                    @php
                                                    $total = $invoice->Amount_collection + $invoice->Amount_commision ;
                                                    @endphp
                                                    <td class="tx-right">
                                                        {{ number_format($total, 2) }}
                                                    </td>
                                                </tr>
            
                                                <tr>
                                                    <td class="valign-middle" colspan="2" rowspan="4">
                                                        <div class="invoice-notes">
                                                            <label class="main-content-label tx-13">#</label>
            
                                                        </div>
                                                    </td>
                                                    <td class="tx-right">الاجمالي</td>
                                                    <td class="tx-right" colspan="2"> {{ number_format($total, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="tx-right">نسبة الضريبة ({{ $invoice->rate_vate }})</td>
                                                    <td class="tx-right" colspan="2">287.50</td>
                                                </tr>
                                                <tr>
                                                    <td class="tx-right">قيمة الخصم</td>
                                                    <td class="tx-right" colspan="2"> {{ number_format($invoice->discount, 2) }}</td>
            
                                                </tr>
                                                <tr>
                                                    <td class="tx-right tx-uppercase tx-bold tx-inverse">الاجمالي شامل الضريبة</td>
                                                    <td class="tx-right" colspan="2">
                                                        <h4 class="tx-primary tx-bold">{{ number_format($invoice->total, 2) }}</h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
									</div>
									<hr class="mg-b-40">
								
									<button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                        class="mdi mdi-printer ml-1"></i>طباعة</button>
									
								</div>
							</div>
						</div>
					</div><!-- COL-END -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection

@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


<script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
        
        </script>

@endsection
