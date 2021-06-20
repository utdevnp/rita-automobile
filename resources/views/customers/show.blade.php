@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <!-- <a href="{{ route('sellers.create')}}" class="btn btn-info pull-right">{{__('add_new')}}</a> -->
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<div class="col-md-7">
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Customer Detail')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_customers" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder=" Type email or name & Enter">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <div class="col-md-3">
            <label>Name</label>
            <p>{{$customer->user->name}}</p>
        </div>
        <div class="col-md-3">
            <label>Email</label>
            <p>{{$customer->user->email}}</p>
        </div>
        <div class="col-md-6">
            <label>Address</label>
            <p>
                {{$customer->user->address}} <br>
                {{$customer->user->city}},
                {{$customer->user->country}},
                {{$customer->user->postal_code}}
            </p>
        </div>

        <div class="col-md-3">
            <label>Phone</label>
            <p>{{$customer->user->phone}}</p>
        </div>
        <div class="col-md-3">
            <label>Balance</label>
            <p>{{$customer->user->balance}}</p>
        </div>
      
    </div>
</div>
</div>

<div class="col-md-5">
<form method="post" action="{{route("customers.update",['id'=>$customer->user->id])}}">
    <input type="hidden" name="id"  value="{{$customer->id}}"/>
    @method("PUT")
    @csrf
    <div class="panel">
        <div class="panel-heading bord-btm clearfix pad-all h-100">
            <h3 class="panel-title pull-left pad-no">{{__('Catagories')}}</h3>
            <button class="pull-right btn btn-primary" type="submit">Save</button>
        </div>
        <div class="panel-body">
            @foreach($categories as $cat)
                <div class="clearfix">
                <hr style="margin:2px;">
                    <input name="category[]" @if(in_array($cat->id,json_decode($customer->user->category))) checked  @endif value="{{$cat->id}}" type="checkbox" /> {{$cat->name}} 
           
            </div>
            
                @if(count($cat->subcategories) >0)
                    @foreach($cat->subcategories as $subcat)
                        <div class="clearfix"> &nbsp; &nbsp; &nbsp; - <input @if(in_array($subcat->id,json_decode($customer->user->sub_category))) checked  @endif  value="{{$subcat->id}}" name="sub_category[]" type="checkbox" /> {{$subcat->name}} </div>

                        @if(count($subcat->subsubcategories) >0)
                            @foreach($subcat->subsubcategories as $subsubcat)
                                <div class="clearfix"> &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; -- <input @if(json_decode($customer->user->sub_sub_category) !=null) @if(in_array($subsubcat->id,json_decode($customer->user->sub_sub_category))) checked  @endif @endif  value="{{$subsubcat->id}}" name="sub_sub_category[]" type="checkbox" /> {{$subsubcat->name}} </div>
                            @endforeach
                        @endif
                        
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
</form>
</div>

@endsection
@section('script')
    <script type="text/javascript">
        function sort_customers(el){
            $('#sort_customers').submit();
        }
    </script>
@endsection
