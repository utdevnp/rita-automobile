@extends('front.layouts.master')

@section('content')



<div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{url("/")}}">home</a></li>
                            <li>Support Ticket</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>


     <!-- my account start  -->
     <div class="account_page_bg">
        <div class="container">
            <section class="main_content_area">  
                <div class="account_dashboard">
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" data-toggle="modal" data-target="#ticket_modal">
                                <i class="la la-plus"></i>
                                <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Create a Ticket') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <!-- Nav tabs -->
                            <div class="dashboard_tab_button">
                                <ul role="tablist" class="nav flex-column dashboard-list">
                                @include("front.customer.nav")
                                </ul>
                            </div>    
                        </div>
                        <div class="col-sm-12 col-md-9 col-lg-9">
                            <!-- Tab panes -->
                            <div class="tab-content dashboard_content">
                            <div class="tab-content dashboard_content">
                                <div class="tab-pane fade show active">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>Support Ticket </h3>
                                        </div>
                                        
                                    </div>
                                       
                                </div>
                                <div class="tab-pane fade active">

                                <div class="card">
                            <div class="card-header py-3">
                                <h3 class="heading-5">{{ $ticket->subject }} #{{ $ticket->code }}</h3>
                                <ul class="list-inline alpha-6 mb-0">
                                    <li class="list-inline-item">{{ date('h:i:m A d-m-Y', strtotime($ticket->created_at)) }}</li>
                                    <li class="list-inline-item"><span class="badge badge-pill badge-secondary">Open</span></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="border-bottom pb-4">
                                    <form class="" action="{{route('support_ticket.seller_store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                        <input type="hidden" name="user_id" value="{{$ticket->user_id}}">
                                        <div class="form-group">
                                            <textarea class="form-control editor" name="reply" placeholder="Type your reply" data-buttons="bold,underline,italic,|,ul,ol,|,paragraph,|,undo,redo"></textarea>
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="file" name="attachments[]" id="file-2" class="custom-input-file custom-input-file--2" data-multiple-caption="{count} files selected" multiple />
                                            <label for="file-2" class=" mw-100 mb-0">
                                                <i class="fa fa-upload"></i>
                                                <span>Attach files.</span>
                                            </label>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-base-1">{{__('Send Reply')}}</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="pt-4">
                                    @foreach ($ticket_replies as $ticketreply)
                                        @if($ticket->user_id == $ticketreply->user_id)
                                            <div class="block block-comment mb-3 border-0">
                                                <div class="d-flex flex-row-reverse">
                                                    <div class="pl-3">
                                                        <div class="block-image d-block size-40" data-toggle="tooltip" data-title="{{ $ticketreply->user->name }}">
                                                            
                                                            @if($ticketreply->user->avatar_original === null)
                                                                <img src="{{ asset($ticketreply->user->avatar_original) }}" class="rounded-circle">
                                                            @else
                                                                <img src="{{ asset('frontend/images/user.png') }}" class="rounded-circle">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ml-5 pl-5">
                                                        <div class="p-3 bg-gray rounded">
                                                            @php echo $ticketreply->reply; @endphp
                                                            @if($ticketreply->files != null && is_array(json_decode($ticketreply->files)))
                                                                <div class="mt-3 clearfix">
                                                                    @foreach (json_decode($ticketreply->files) as $key => $file)
                                                                        <div class="float-right bg-white p-2 rounded ml-2">
                                                                            <a href="{{ asset($file->path) }}" download="{{ $file->name }}" class="file-preview d-block text-black-50" style="width:100px">
                                                                                <div class="text-center h4">
                                                                                    <i class="la la-file"></i>
                                                                                </div>
                                                                                <div class="d-flex">
                                                                                    <div class="flex-grow-1 minw-0">
                                                                                        <div class="text-truncate">
                                                                                            {{ explode('.', $file->name)[0] }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div>
                                                                                        .{{ explode('.', $file->name)[1] }}
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <span class="comment-date alpha-5 text-sm mt-1 d-block text-right">
                                                            {{ date('h:i:m d-m-Y', strtotime($ticketreply->created_at)) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="block block-comment mb-3 border-0">
                                                <div class="d-flex">
                                                    <div class="pr-3">
                                                        <div class="block-image d-block size-40" data-toggle="tooltip" data-title="{{ $ticketreply->user->name }}">
                                                            <img loading="lazy"  src="{{ asset($ticketreply->user->avatar_original) }}" class="rounded-circle" data-toggle="tooltip" data-title="fsdfsf">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 mr-5 pr-5">
                                                        <div class="p-3 bg-gray rounded">
                                                            @php echo $ticketreply->reply; @endphp
                                                            @if($ticketreply->files != null && is_array(json_decode($ticketreply->files)))
                                                                <div class="mt-3 clearfix">
                                                                    @foreach (json_decode($ticketreply->files) as $key => $file)
                                                                        <div class="float-right bg-white p-2 rounded ml-2">
                                                                            <a href="{{ asset($file->path) }}" download="{{ $file->name }}" class="file-preview d-block text-black-50" style="width:100px">
                                                                                <div class="text-center h4">
                                                                                    <i class="la la-file"></i>
                                                                                </div>
                                                                                <div class="d-flex">
                                                                                    <div class="flex-grow-1 minw-0">
                                                                                        <div class="text-truncate">
                                                                                            {{ explode('.', $file->name)[0] }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div>
                                                                                        .{{ explode('.', $file->name)[1] }}
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <span class="comment-date alpha-5 text-sm mt-1 d-block">
                                                            {{ date('h:i:m d-m-Y', strtotime($ticketreply->created_at)) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="block block-comment mb-3 border-0">
                                        <div class="d-flex flex-row-reverse">
                                            <div class="pl-3">
                                                <div class="block-image d-block size-40">
                                                    <img loading="lazy"  src="{{ asset($ticket->user->avatar_original) }}" class="rounded-circle">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ml-5 pl-5">
                                                <div class="p-3 bg-gray rounded">
                                                    @php echo $ticket->details; @endphp
                                                    @if($ticket->files != null && is_array(json_decode($ticket->files)))
                                                        <div class="mt-3 clearfix">
                                                            @foreach (json_decode($ticket->files) as $key => $file)
                                                                <div class="float-right bg-white p-2 rounded ml-2">
                                                                    <a href="{{ asset($file->path) }}" download="{{ $file->name }}" class="file-preview d-block text-black-50" style="width:100px">
                                                                        <div class="text-center h4">
                                                                            <i class="la la-file"></i>
                                                                        </div>
                                                                        <div class="d-flex">
                                                                            <div class="flex-grow-1 minw-0">
                                                                                <div class="text-truncate">
                                                                                    {{ explode('.', $file->name)[0] }}
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                .{{ explode('.', $file->name)[1] }}
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                                <span class="comment-date alpha-5 text-sm mt-1 d-block text-right">
                                                    {{ date('h:i:m d-m-Y', strtotime($ticket->created_at)) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                                   
                                </div>
                                
                                
                        </div>
                    </div>
                </div>        	
            </section>
        </div>	
    </div>	



    
<div class="modal fade" id="ticket_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">{{__('Create a Ticket')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-3 pt-3">
                <form class="" action="{{ route('support_ticket.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-3" name="subject" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <label>Provide a detailed description <span class="text-danger">*</span></label>
                        <textarea class="form-control editor" name="details" placeholder="Type your reply" data-buttons="bold,underline,italic,|,ul,ol,|,paragraph,|,undo,redo"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="attachments[]" id="file-2" class="custom-input-file custom-input-file--2" data-multiple-caption="{count} files selected" multiple />
                        <label for="file-2" class=" mw-100 mb-0">
                            <i class="fa fa-upload"></i>
                            <span>Attach files.</span>
                        </label>
                    </div>
                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
                        <button type="submit" class="btn btn-base-1">{{__('Send Ticket')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection