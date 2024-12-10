@extends('layouts.master')
@section("title" , "sections")
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
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  المنتجات</span>
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
								{{-- @if(session()->has("success"))
									<div class="alert text-center alert-success alert-dismissible">
										{{session()->get("success")}}
                                    
                                    									</div>
								@endif
								@if(session()->has("deleted"))
									<div class="alert text-center alert-success alert-dismissible">
										{{session()->get("deleted")}}
									</div>
								@endif --}}
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
@endsection
@section('content')
				<!-- row -->
				<div class="row">
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								@if (Auth::user()->hasRole(["admin"]))
									<div class="d-flex justify-content-between">
										<h4 class="card-title mg-b-0"><a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo1">انشاء منتج- </a></h4>
									</div>
								@endif
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="wd-5p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0"> اسم المنتج </th>
												<th class="wd-15p border-bottom-0"> الوصف </th>
												<th class="wd-15p border-bottom-0">اسم القسم</th>
												@if (Auth::user()->hasRole("admin"))
													
													<th class="wd-15p border-bottom-0"> العمليات</th>
												@endif
												<th class="wd-15p border-bottom-0"> </th>
											</tr>
										</thead>
										<tbody>
											@foreach ($products as $product)
												<tr>
													<td>{{$product->id}}</td>
													<td> {{$product->product_name}}</td>
													<td>{{$product->description}} </td>
													@if ({{ Auth::user()->hasRole("admin") }})
														
														<td>
															<div class="row">
																
																<a class="modal-effect btn btn-outline-success" data-effect="effect-scale"
																data-id="{{ $product->id }}" data-product_name="{{ $product->product_name }}"
																data-section_id="{{$product->section_id}}"
																data-description="{{ $product->description }}" data-toggle="modal" href="#exampleModal2"
																title="تعديل"> edit<i class="las la-pen"></i></a>
																
																<a class="modal-effect btn btn-outline-danger " data-effect="effect-scale"
																data-id="{{ $product->id }}"
																data-product_name="{{$product->product_name}}" data-toggle="modal" href="#modaldemo9"
																title="تعديل"> delete<i class="las la-pen"></i></a>
															</div>
														</td>
													@endif
													<td> </td>
												</tr>
											@endforeach
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					{{-- the create section --}}
					<div class="modal" id="modaldemo1">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo">
								<div class="modal-header">
									<h6 class="modal-title">Basic Modal</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<form action="{{route("products.store")}}" method="POST">
											@csrf
											<label calss=" text-success text-xl"  for=""> products name</label>
											<input class="form-control" type="text" class="form-control w-75  m-3" placeholder="the name of product " id="product_name"  name="product_name">
                                            <br>
											<select name="section_id" class="form-control" id="section_id">
                                                @foreach ($sections as $section )
                                                        <option value="{{$section->id}}">{{$section->section_name}}</option>
                                                @endforeach
                                            </select>
                                            <br>
											<label  calss=" text-success text-xl" for=""> description </label>
											<input class="form-control" type="text" class="form-control  w-75 m-3" placeholder="the   description " id="description" name="description">
                                            <br>
											<button type="submit" class="btn btn-primary">submit</button>
									</form>
									</div>
								<div class="modal-footer">
									{{-- <button class="btn ripple btn-primary" type="submit">Save changes</button>
									<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button> --}}
								</div>
							</div>
						</div>
					</div>
					{{-- the edit --}}
					<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
							aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">

									<form action="products/update" method="post" autocomplete="off">
										{{method_field('patch')}}
										{{csrf_field()}}
										<div class="form-group">
											<input type="hidden" name="id" id="id" value="">
											<label for="recipient-name" class="col-form-label">اسم المنتج:</label>
											<input class="form-control" name="product_name" id="product_name" type="text">
										</div>
                                        <div class="form-group">
                                            <select name="section_id" class="form-control" id="section_id">
                                                @foreach ($sections as $section )
                                                        <option value="{{$section->id}}">{{$section->section_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
										<div class="form-group">
											<label for="message-text" class="col-form-label">ملاحظات:</label>
											<textarea class="form-control" id="description" name="description"></textarea>
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
			   {{-- the delete --}}
			   <div class="modal" id="modaldemo9">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
																			type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<form action="products/destroy" method="post">
								{{method_field('delete')}}
								{{csrf_field()}}
								<div class="modal-body">
									<p>هل انت متاكد من عملية الحذف ؟</p><br>
									<input type="hidden" name="id" id="id" value="">
									<input class="form-control" name="product_name" id="product_name" type="text" readonly>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
									<button type="submit" class="btn btn-danger">تاكيد</button>
								</div>
						</div>
						</form>
					</div>
				</div>
					{{-- the end of content --}}
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
<script>
	$('#exampleModal2').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var product_name = button.data('product_name')
		var section_id = button.data('section_id')
		var description = button.data('description')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #product_name').val(product_name);
		modal.find('.modal-body #section_id').val(section_id);
		modal.find('.modal-body #description').val(description);
	})
</script>

<script>
	$('#modaldemo9').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var product_name = button.data('product_name')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #product_name').val(product_name);
	})
</script>
@endsection