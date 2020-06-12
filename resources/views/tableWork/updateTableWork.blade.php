@extends('index')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Nueva Mesa de trabajo Techo Chile</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{Storage::url(auth()->user()->avatar ?? 'default.png')}}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"></h3>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Ingrese datos para nueva mesa de trabajo</b>
                            </li>
                        </ul>
                        <a href="#" id="btn-guardar" class="btn btn-primary btn-block"><b>Guardar</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <b>Datos de nueva mesa de trabajo</b>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-horizontal" id="table-form">
                            <div class="form-group row">
                                @csrf
                                <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="{{$table->name ?? ''}}" placeholder="{{$table->name?? 'Nombre'}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id">
                                        <option value="">Seleccione una Región</option>
                                        @foreach($region as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class=" form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Comuna</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="comuna" value="{{$table->comuna ?? ''}} " placeholder="{{$table->comuna ?? 'comuna'}}">
                                </div>
                            </div>
                            <div class=" form-group row">
                                <label for="inputLocate" class="col-sm-2 col-form-label">Comunidad</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="comunidad" value="{{$table->comunidad ?? ''}}" placeholder="{{$table->comunidad ?? 'Comunidad'}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="imputPhone" class="col-sm-2 col-form-label">Latitud</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="latitud" value="{{$table->latitud ?? ''}}" placeholder="{{$table->latitud ?? 'Latitud'}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="imputPhone" class="col-sm-2 col-form-label">Longitud</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="longitud" value="{{$table->longitud ?? ''}}" placeholder="{{$table->longitud ?? 'Longitud'}}">
                                </div>
                            </div>
                        </form>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<script>
    $(document).ready(function() {
        $('#btn-guardar').click(function() {
            var data = $('#profile-form').serialize();
            var url = "{{route ('newTableWork')}}";
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(data) {
                    alert('Los cambios se han realizado con éxito');
                }
            });
        });
    });
</script>
@endsection