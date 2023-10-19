@extends('adminlte::page')

@section('title', 'Cars')

@section('content_header')
    <h1>Cars</h1>
@stop

@section('content')
    <p>Car list</p>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{$message}}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cars</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Model</th>
                                <th>Color</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                    <tr>
                                        <td>{{$car->id}}</td>
                                        <td>{{$car->name}}</td>
                                        <td>{{$car->model}}</td>
                                        <td>{{$car->color}}</td>

                                        <td>
                                            {{-- edit --}}
                                            <a href="{{route('admincars.edit', $car->id)}}" style="margin-right: 10px;" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- delete --}}
                                            <a href="{{route('admincars.destroy', $car->id)}}" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
