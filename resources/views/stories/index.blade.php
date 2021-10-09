@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Stories
                    <a href="{{ route('stories.create') }}" class="float-right">Add Story</a>
                       
                </div>

                <div class="card-body">
                    <table class="table">

                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                               
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($stories as $story)

                            <tr>
                                <td>{{ $story->title }}</td>
                                <td>{{ $story->type }}</td>
                                <td>{{ $story->status === 1 ? "Yes" : "No" }}</td>
                                
                                <td><a href="{{ route('stories.show',[$story->id]) }}" class="btn   btn-secondary">View</a>
                                    <a href="{{ route('stories.edit',[$story->id]) }}" class="btn btn-secondary">Edit</a>
                                   
                                    <form style="display: inline-block" action="{{ route('stories.destroy' , [$story->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger">Delete</button>

                                    
                                    </form>
                                </td>
                            </tr>    
                            @endforeach
                        </tbody>
                    </table>
                    {{ $stories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection