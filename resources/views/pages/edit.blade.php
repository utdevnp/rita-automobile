@extends('layouts.app')

@section('content')

    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('Page Informations')}}</h3>
            </div>
            <!--Horizontal Form-->
            <!--===================================================-->
            <form class="form-horizontal mb-5" action="{{ route('pages.update', $page->id) }}" method="POST"
                  enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
                @csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" value="{{$page->name}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="position">{{__('Position')}}</label>
                        <div class="col-sm-10">
                            <select class="form-control demo-select2" name="position" id="position" onchange="{ getParents(this); updateWeight(); }" required>

{{--                                @foreach($page->arrPositions as $val)--}}
{{--                                    <option value="{{$val}}" @if($page->position == $val) {{"selected"}} @endif>{{$val}}</option>--}}
{{--                                @endforeach--}}
                                <option value="">{{__('Select Position')}}</option>
                                <option value="{{__('Header')}}" @if($page->position == 'Header') {{"selected"}} @endif>{{__('Header')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="type">{{__('Page Type')}}</label>
                        <div class="col-sm-10">
                            <select class="form-control demo-select2" name="type" id="type" required>
                                <option value="{{__('Content')}}">{{__('Content')}}</option>
                                <option value="{{__('Link')}}">{{__('Link')}}</option>
                            </select>
                        </div>
                    </div>
                    <div id="descriptionBlock">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="description">{{__('Description')}}</label>
                            <div class="col-sm-10">
                                <textarea class="editor" id="description" name="description">{{$page->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div id="linkBlock">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="link">{{__('Link')}}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="link" name="link" value="{{$page->description}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="parentId">{{__('Parent')}}</label>
                        <div class="col-sm-10" id="parentBlock">
                            <select class="form-control demo-select2" name="parentId" id="parentId" onchange="updateWeight();">
                                <option value="0">{{__('Select Parent')}}</option>
                                @if($page->parents)
                                    @foreach($page->parents as $key=>$parent)
                                        <option value="{{$parent->id}}"@if($parent->id == $page->parentId) {{ 'selected' }} @endif>{{$parent->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="banner">{{__('Banner')}}</label>
                        <div class="col-sm-10">
                            <input type="file" id="banner" name="banner" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="video">{{__('Video')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="video" id="video"
                                   placeholder="{{__('Youtube Video Link')}}" value="{{$page->video}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="weight">{{__('Weight')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="weight" id="weight" value="{{$page->weight}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{__('Meta Title')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="meta_title"
                                   placeholder="{{__('Meta Title')}}" value="{{$page->meta_title}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{__('Description')}}</label>
                        <div class="col-sm-10">
                            <textarea name="meta_description" rows="8" class="form-control">{{$page->meta_description}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{__('Send')}}</button>
                </div>
            </form>
            <!--===================================================-->
            <!--End Horizontal Form-->

        </div>
    </div>
    <div class="clearfix"></div>
@endsection


@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#linkBlock').hide();

            $('#type').change(function () {
                if ($(this).val() == "Link") {
                    $('#descriptionBlock').hide();
                    $('#linkBlock').show();
                } else if($(this).val() == "Content") {
                    $('#linkBlock').hide();
                    $('#descriptionBlock').show();
                }
            })
        })

        function updateWeight() {

            //$('#position, #parentId').change(function(data) {
            $.post('{{ route('pages.weight') }}', {
                _token: '{{ csrf_token() }}',
                position: $('#position').val(),
                parentId: $('#parentId').val(),
                prevPosition: '{{$page->position}}',
                prevParent: '{{$page->parentId}}',
                prevWeight: '{{$page->weight}}'
            }, function (data) {
                $('#weight').val(data);
            });
            //})
        }

        function getParents(el) {

            $.post('{{ route('pages.parent') }}', {
                _token: '{{ csrf_token() }}',
                position: el.value,
                selected: '{{$page->parentId}}',
                id: '{{$page->id}}'
            }, function (data) {
                //alert(data);
                $('#parentBlock').html(data);
                $(".demo-select2").select2();
            });
            //})
        }
    </script>
@endsection
