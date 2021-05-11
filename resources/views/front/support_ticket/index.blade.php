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
                                <div class="card no-border mt-4">
                                        <table class="table table-sm table-hover table-responsive-md">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Ticket ID') }}</th>
                                                    <th>{{ __('Sending Date') }}</th>
                                                    <th>{{__('Subject')}}</th>
                                                    <th>{{__('Status')}}</th>
                                                    <th>{{__('Options')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($tickets) > 0)
                                                    @foreach ($tickets as $key => $ticket)
                                                        <tr>
                                                            <td>#{{ $ticket->code }}</td>
                                                            <td>{{ $ticket->created_at }}</td>
                                                            <td>{{ $ticket->subject }}</td>
                                                            <td>
                                                                @if ($ticket->status == 'pending')
                                                                    <span class="badge badge-pill badge-danger">Pending</span>
                                                                @elseif ($ticket->status == 'open')
                                                                    <span class="badge badge-pill badge-secondary">Open</span>
                                                                @else
                                                                    <span class="badge badge-pill badge-success">Solved</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{route('support_ticket.show', encrypt($ticket->id))}}" class="btn btn-styled btn-link py-1 px-0 icon-anim text-underline--none">
                                                                    {{__('View Details')}}
                                                                    <i class="la la-angle-right text-sm"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td class="text-center pt-5 h4" colspan="100%">
                                                            <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                                            <span class="d-block">{{ __('No history found.') }}</span>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="pagination-wrapper py-4">
                                        <ul class="pagination justify-content-end">
                                            {{ $tickets->links() }}
                                        </ul>
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