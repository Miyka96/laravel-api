@extends('layouts.app')

@section('content')

    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Author</td>
                    <td>Title</td>
                    <td>Slug</td>
                    <td>Category</td>
                    <td>Tags</td>
                    <td>Published at</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
    
            <tbody>
                <tr>
                    @foreach ($posts as $post)
                        {{-- id --}}
                        <td>{{ $post->id }}</td>
                        {{-- author --}}
                        <td>
                            <a data-bs-toggle="tooltip" data-bs-placement="left" title="See all {{$post->user->name}} posts" href="{{route('admin.user.posts', $post->user->id)}}">{{$post->user->name}}</a>
                        </td>
                        {{-- title --}}
                        <td class="text-capitalize">{{ $post->title }}</td>
                        {{-- slug --}}
                        <td>{{ $post->slug }}</td>
                        {{-- category --}}
                        <td>{{ isset($post->category) ? $post->category->name : '--' }}</td>
                        {{-- tags --}}
                        <td>
                            @foreach ($post->tags as $tag)

                                <span class="badge badge-info">{{$tag->name}}</span>

                            @endforeach
                        </td>
                        
                        {{-- published_at --}}
                        <td>{{ $post->published_at == null ? '--' : $post->published_at }}</td>
                        {{-- edit button --}}
                        <td><button class="btn btn-primary"><a class="text-white"
                                    href="{{ route('admin.posts.edit', $post) }}">Edit/Preview</a></button></td>
                        {{-- delete button --}}
                        <td>
                            <form action="{{route('admin.posts.destroy',$post)}}" method="post">
                                @CSRF
                                @method('delete')
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Delete this record?')"> Delete</button>
                            </form>
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection
