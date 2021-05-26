@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('vehiclemodel.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Subcategory')}}</a>
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Vehicle Model')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_subcategories" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder=" Type name & Enter">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Vehicle Model')}}</th>
                    <th>{{__('Segment')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vehiclemodel as $key => $subcategory)
                    <tr>
                        <td>{{ ($key+1) + ($vehiclemodel->currentPage() - 1)*$vehiclemodel->perPage() }}</td>
                        <td>{{__($subcategory->name)}}</td>
                        <td>@if(! empty($subcategory->segment->name)){{$subcategory->segment->name}} @endif</td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('vehiclemodel.edit', encrypt($subcategory->id))}}">{{__('Edit')}}</a></li>
                                    <li><a onclick="confirm_modal('{{route('vehiclemodel.destroy', $subcategory->id)}}');">{{__('Delete')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $vehiclemodel->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
