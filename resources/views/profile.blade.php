@extends('templates.default')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if(Session::has('message'))
                    <div class="alert alert-success">
                        <strong>Успешно!</strong>
                        {{session('message')}}
                    </div>
                @elseif(Session::has('error_message'))
                    <div class="alert alert-danger">
                        <strong>Ошибка:</strong>
                        {{session('error_message')}}
                    </div>
                @endif
                @if(isset($errorsUplod))
                    <div class="alert alert-danger">
                        <strong>Ошибка:</strong>
                        {{$errorsUplod}}
                    </div>
                @endif
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"> <p class="h4">Мой профиль</p> </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('save_profile') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }} input-group-lg">
                                            <input type="name" class="form-control text-center" name="name"
                                                   @if(old('name')){
                                                   value = "{!! old('name')  !!}"
                                                   @elseif(!empty($user->name)){
                                                   value ="{!! $user->name !!}"
                                                   @endif
                                                   required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-4 col-md-8 col-md-offset-4 col-sm-10 col-sm-offset-2 col-xs-10 col-xs-offset-2">

                                    <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">

                                        @if(Storage::disk('public')->exists($user->avatar))
                                            <div>
                                                <img class="img-thumbnail" id = "avatar"
                                                     src="{{ Storage::disk('public')->url($user->avatar)}}">
                                                <br> <br>
                                                <button type="button" class="btn btn-sm btn-danger" href="#" onclick="deleteImage(avatar);" id = "delete_avatar">
                                                    <i class="glyphicon glyphicon-trash"> Удалить аватар</i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-success hidden" href="#" onclick="restoreImage(avatar);" id = "restore_avatar">
                                                    <i class="glyphicon glyphicon-refresh"> Восстановить аватар</i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="delete_avatar" value="">
                                            <br>
                                        @endif
                                        <input type="file" id = "file_avatar" name="avatar">
                                        @if ($errors->has('avatar'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Сохранить профиль
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteImage(el){
            var name = $(el).attr('name');
            $('#' + name).addClass('hidden');
            $('#restore_' + name).removeClass('hidden');
            $('#delete_' + name).addClass('hidden');
            $('input[name=delete_' + name + ']').val('1');
        }

        function restoreImage(el){
            var name = $(el).attr('name');
            $('#' + name).removeClass('hidden');
            $('#restore_' + name).addClass('hidden');
            $('#delete_' + name).removeClass('hidden');
            $('input[name=delete_' + name + ']').val('');
        }
    </script>
@stop