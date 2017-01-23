@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table">
                        <thead class="thead-inverse">

                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Role</th>
                                @if($edit)
                                <th></th>
                                @endif; 
                            </tr>
                        </thead>
                        @forelse($users as $user)
                        <tr>
                            <td>
                                {{$user->name}}
                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                            <td>
                                {{$user->role->description}}
                            </td>
                            @if($edit)
                            <td>
                                <a href="{!! route('edit_user', ['userId' => $user->id]) !!}"><img src="{!! asset('img/edit_icon.png') !!}" style = "width:18px"></span></a>
                                <a href="{!! route('delete_user', ['userId' => $user->id]) !!}"><img src="{!! asset('img/delete_icon.png') !!}" style="width: 18px"></span></a>
                            </td>
                            @endif;
                        </tr>
                        @empty
                        <tr>
                            <p>There are no users yet!</p>
                        </tr>
                        @endforelse
                    </table>
                    <div style = "float: right">
                        @if($edit)
                        <a class="btn btn-primary" href="/deleted-users" role="button">Deleted Users</a>
                        @else
                        <a class="btn btn-primary" href="/" role="button"> Users</a>
                        @endif;
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
