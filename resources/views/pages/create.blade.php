@extends('layouts.app')

@section('content')

    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('Page Informations')}}</h3>
            </div>
            <!--Horizontal Form-->
            <!--===================================================-->
            <form class="form-horizontal mb-5" action="{{ route('pages.store') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="position">{{__('Position')}}</label>
                        <div class="col-sm-10">
                            <select class="form-control demo-select2" name="position" id="position" onchange="{ getParents(this); updateWeight(); }" required>
                                <option value="">{{__('Select Position')}}</option>
                                <option value="{{__('Header')}}">{{__('Header')}}</option>
                                <option value="{{__('Useful Link')}}">{{__('Useful Link')}}</option>
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
                                <textarea class="editor" id="description" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="linkBlock">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="link">{{__('Link')}}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="link" name="link">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="parentId">{{__('Parent')}}</label>
                        <div class="col-sm-10" id="parentBlock">
                            <select class="form-control demo-select2" name="parentId" id="parentId" onchange="updateWeight();">
                                <option value="0">{{__('Select Parent')}}</option>
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
                                   placeholder="{{__('Youtube Video Link')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="weight">{{__('Weight')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="weight" id="weight" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{__('Meta Title')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="meta_title"
                                   placeholder="{{__('Meta Title')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{__('Description')}}</label>
                        <div class="col-sm-10">
                            <textarea name="meta_description" rows="8" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{__('Send')}}</button>
                </div>
            </form>
            <!--===================================================-->
            <!--End Horizontal Form-->
<div id="aa"></div>
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
                prevPosition: '',
                prevParent: '',
                prevWeight: ''
            }, function (data) {
                $('#weight').val(data);
            });
            //})
        }

        updateWeight();

        function getParents(el) {
            $.post('{{ route('pages.parent') }}', {
                _token: '{{ csrf_token() }}',
                position: el.value,
                selected: '',
                id: ''
            }, function (data) {
                //alert(data);
                $('#parentBlock').html(data);
                $(".demo-select2").select2();
            });
            //})
        }

        {{--function update_status(el){--}}
        {{--    if(el.checked){--}}
        {{--        var status = 1;--}}
        {{--    }--}}
        {{--    else{--}}
        {{--        var status = 0;--}}
        {{--    }--}}
        {{--    $.post('{{ route('pages.status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){--}}
        {{--        if(data == 1){--}}
        {{--            showAlert('success', 'Page status updated successfully');--}}
        {{--        }--}}
        {{--        else{--}}
        {{--            showAlert('danger', 'Something went wrong');--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}
    </script>
@endsection
