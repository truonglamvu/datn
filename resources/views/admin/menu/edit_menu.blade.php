@extends('layouts.layout_admin')
@section('content')
	<div class="row">
        <div class="col-sm-9">
            <h3>Cập nhật Menu</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul style="list-style: none;">
                        @foreach ($errors->all() as $error)
                            <li><font color="red">(*)</font>{{ $error }}</li>
                        @endforeach
                        
                    </ul>
                </div>
            @endif
        </div>
        
        <div class="col-sm-9">
            <form action="{{ route('menu.update',$menu->id) }}" method="POST" class="form-horizontal" role="form">
           	{{ csrf_field() }}
            {{ method_field("PUT") }}
                <div class="form-group row">
                    <label for="" class="col-sm-2 control-label">Menu Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="menu_name" value="{{ $menu->menu_name }}">
                        @if ($errors->has('menu_name'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('menu_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    @if(!$menus->isEmpty())
                        <label class="col-sm-2 control-label">Menu parent</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="id_menu_parent">
                                <option value="0"> - Chọn 1 mục - </option>
                                @foreach($menus as $menu)
                                        <option value="{{ $menu->id }}">
                                            @for ($i = 0; $i < $menu->level; $i++)
                                                -
                                            @endfor
                                            {{ $menu->menu_name }}
                                        </option>
                                        @if(isset($menu->child))
                                            @foreach($menu->child as $child)
                                                <option value="{{ $child->id }}">
                                                @for ($j = 0; $j < $child->level; $j++)
                                                    -
                                                @endfor
                                                {{ $child->menu_name }}
                                            </option>
                                            @endforeach
                                        @endif
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
                
                <button type="submit" class="btn btn-primary" style="float:right;">Cập nhật</button>
            </form>
            <a href="{{ route('permissionBackPage') }}" class="btn btn-success" style="margin-top:270px;width: 120px; "><i class="fa fa-reply" aria-hidden="true"></i></a>
        </div>
     </div>
@endsection