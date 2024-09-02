@extends('admin.admin_layout')
@section('title','Admin | Contacts')

@section('content')

    <div class="users_list">
        <div class="container">
            <h1 class="my-4">All Contacts</h1>
            <table class="table table-bordered table-striped text-center">
                <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Created at</th>
                    <th>Published at</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                @if($contacts->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">No users found.</td>
                    </tr>
                @else
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact['id'] }}</td>
                            <td>{{ $contact->username }}</td>
                            <td>{{ $contact->title }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>{{ $contact -> created_at}}</td>
                            <td>{{ $contact['published_at'] }}</td>
                            <td><a href="" class="btn btn-primary">Edit</a> <a href="/delete?model_name=contacts&id={{$contact->id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
{{--                            <td><a href="" class="btn btn-primary">Edit</a> <a href="{{route('delete',$user->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>--}}
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
{{--            {{$contacts->links()}}--}}
        </div>
    </div>
@endsection
