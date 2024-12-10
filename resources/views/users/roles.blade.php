@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex"><h4 class="content-title mb-0 my-auto">المستخدم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الصلاحيات</span></div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm main-content-mail">
					
					<div class="col-lg-8 col-xl-9 col-md-12">
						<div class="card">
							<div class="main-content-body main-content-body-mail card-body">
								<div class="main-mail-header">
									<div>
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title mg-b-0"><a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo1">انشاء الصلاحيات </a></h4>
                                        </div>
										<h4 class="main-content-title mg-b-5">الصلاحيات</h4>
										<p>You have {{ $count }} unread messages</p>
									</div>
									<div>
										<div class="btn-group" role="group">
											<button class="btn btn-outline-secondary disabled" type="button"><i class="icon ion-ios-arrow-forward"></i></button> <button class="btn btn-outline-secondary" type="button"><i class="icon ion-ios-arrow-back"></i></button>
										</div>
									</div>
								</div><!-- main-mail-list-header -->
							
								<div class="main-mail-list">
									<div class="main-mail-item unread">
										
									
                                        <table id="example" class="table key-buttons text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="wd-15p border-bottom-0">ترتيب المستخدم  </th>
                                                    <th class="wd-15p border-bottom-0">اسم الصلاحيات </th>
                                                    <th class="wd-15p border-bottom-0">اسم الاذون </th>
                                                    <th class="wd-15p border-bottom-0"> العمليات </th>
													
                                                  
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 0;
                                                @endphp
                                              @foreach ($roles as $role)
                                              @php
                                                  $i++;
                                              @endphp
                                              <tr>
                                                <th class="wd-15p border-bottom-0">{{$i}} </th>
                                                <th class="wd-15p border-bottom-0">{{$role->name}} </th>
                                                <th class="wd-15p border-bottom-0">
                                                    @foreach ($rolePermissions as $per)
                                                    @foreach ($permissions as $permission)
                                                            <p>{{ $per->role_id == $role->id ? 
                                                            $permission->id == $per->permission_id ? 
                                                                        $permission->name : ""  : ""}}</p>
                                                    @endforeach
                                                    @endforeach
                                                </th>
                                                
												<th>
													<a  class="dropdown-item btn" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$role->id}}">delete</a>
												</th>


                                            </tr>
                                                  
                                              @endforeach
                                           
                                            </tbody>
                                        </table>
										
									</div>
								</div>
								<div class="mg-lg-b-30"></div>
							</div>
						</div>
					</div>
					<div class="main-mail-compose">
						<div>
							<div class="container">
								<div class="main-mail-compose-box">
									<div class="main-mail-compose-header">
										<span>New Message</span>
										<nav class="nav">
											<a class="nav-link" href=""><i class="fas fa-minus"></i></a> <a class="nav-link" href=""><i class="fas fa-compress"></i></a> <a class="nav-link" href=""><i class="fas fa-times"></i></a>
										</nav>
									</div>
									<div class="main-mail-compose-body">
										<div class="form-group">
											<label class="form-label">To</label>
											<div>
												<input class="form-control" placeholder="Enter recipient's email address" type="text">
											</div>
										</div>
										<div class="form-group">
											<label class="form-label">Subject</label>
											<div>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="form-group">
											<textarea class="form-control" placeholder="Write your message here..." rows="8"></textarea>
										</div>
										<div class="form-group mg-b-0">
											<nav class="nav">
												<a class="nav-link" data-toggle="tooltip" href="" title="Add attachment"><i class="fas fa-paperclip"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Add photo"><i class="far fa-image"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Add link"><i class="fas fa-link"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Emoticons"><i class="far fa-smile"></i></a> <a class="nav-link" data-toggle="tooltip" href="" title="Discard"><i class="far fa-trash-alt"></i></a>
											</nav><button class="btn btn-primary">Send</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->
                
	{{-- the create user --}}
    <div class="modal" id="modaldemo1">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">create user</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route("roles.store")}}" method="POST">
                            @csrf
                            <label calss=" text-success text-xl"  for=""> roles name</label>
                            <input type="text" class="form-control w-75  m-3" placeholder="the name of role " id="user_name"  name="role">
                           
                            <h4>the permissions</h4>
                                @foreach ($permissions as $permission)
                                    <div>
                                        <label for="{{ $permission->name  }}">{{ $permission->name  }}</label>
                                        <input name="permission[]" type="checkbox" name="subscribe" id="{{ $permission->name  }}" value="{{ $permission->name  }}">
                                    </div>
                                    
                                @endforeach
                                 
                            <button type="submit" class="btn btn-primary mt-4">submit</button>
                    </form>
                    </div>
                <div class="modal-footer">
                    {{-- <button class="btn ripple btn-primary" type="submit">Save changes</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button> --}}
                </div>
            </div>
        </div>
    </div>
			</div><!-- container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--- Internal Check-all-mail js -->
<script src="{{URL::asset('assets/js/check-all-mail.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
{{-- the create user secion --}}

<script>
	$('#modaldemo9').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var section_name = button.data('section_name')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #section_name').val(section_name);
	})
</script>

{{-- the script of deletion model  --}}

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



{{-- the deletion part --}}


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

                <form action="{{route('roles.delete')}}">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id">
                    </div>
                    <button class="btn btn-danger" type="submit"> delete </button>
                </form>
            </div>
        
        </div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>