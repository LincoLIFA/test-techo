@extends('index')

@section('content')
<script>
    $(document).ready(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBL8rFtgXOvnzsJuWoWh7mj2rFSmwv5VE8&callback=initMap">
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Registro de Dueños</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section id="api" class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- SEARCH FORM -->
                    <form id="region-form" class="form-inline ml-3">
                        @csrf
                        <div class="input-group input-group-sm">
                            <select class="form-control" name="id">
                                <option value="">Seleccione una Región</option>
                                @foreach($region as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-navbar" id="btn-search" type="botton">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Región</th>
                                <th>Comuna</th>
                                <th>Comunidad</th>
                                <th>Latitud</th>
                                <th>Longitud</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>
                                    <a href="">{{$item->id}}</a>
                                </td>
                                <td>
                                    <button type="botton" id="btn-send" class="btn btn-outline-secondary btn-block" data-toggle="modal" data-target="#Google-maps">
                                        {{$item->nombre}}
                                    </button>
                                </td>
                                <td>
                                    {{$item->region}}
                                </td>
                                <td>
                                    {{$item->comuna}}
                                </td>
                                <td>
                                    {{$item->comunidad}}
                                </td>
                                <td id="lat">
                                    {{$item->latitud}}
                                </td>
                                <td id="lon">
                                    {{$item->longitud}}
                                </td>

                                <td>
                                    <div class="row">
                                        <a href="#" class="btn btn-primary mr-1"> <i class="far fa-edit"></i></a>
                                        <form method="post" action="#">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-primary" type="submit"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                    </div>

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Región</th>
                                <th>Comuna</th>
                                <th>Comunidad</th>
                                <th>Latitud</th>
                                <th>Longitud</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<div class="modal fade" id="Google-maps">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="map" class="modal-content" style="width:100%; height:500px">

            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    $(document).ready(function() {
        $("#Google-maps").on("shown.bs.modal", function() {
            google.maps.event.trigger(map, "resize");
        });
    });
</script>
<script>
    (function(exports) {
        "use strict";

        function initMap() {
            var lat = $("#lat").val();
            var lon = $("#lon").val();
            var coord = {
                lat: lat,
                lng: lon
            };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: coord
            });
            var marker = new google.maps.Marker({
                position: coord,
                map: map
            });
        }

        exports.initMap = initMap;
    })((this.window = this.window || {}));
</script>
<script>
    $(document).ready(function() {
        $('#btn-search').click(function() {
            var data = $('#region-form').serialize();
            var url = "{{route ('search-region')}}";
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                complete: function(data) {

                }
            });
        });
    });
</script>
@endsection