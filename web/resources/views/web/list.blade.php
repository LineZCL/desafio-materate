@extends('layouts.app')

@section('content')
<div class="container">
    <table>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Role</th>
            <th></th> 
        <tr>

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
                <td>
                    <a href="{!! route('delete_user', ['userId' => $user->id]) !!}">delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <p>There are no users yet!</p>
            </tr>
        @endforelse
    </table>
</div>
@endsection
