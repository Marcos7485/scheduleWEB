@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')

<div class="page_5 custom-show">
    <div>
        <h1>Horario de atención</h1>
        <table id="disp-horaria">
            <thead>
                <tr>
                    <th></th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miercoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Sabado</th>
                    <th>Domingo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Estado</td>
                    @if(json_decode($info->lunes) !== "Cerrado")
                    <td><button class="btn btn-success">Abierto</button></td>
                    @else
                    <td><button class="btn btn-danger" disabled>Cerrado</button></td>
                    @endif
                    @if(json_decode($info->martes) !== 'Cerrado')
                    <td><button class="btn btn-success">Abierto</button></td>
                    @else
                    <td><button class="btn btn-danger" disabled>Cerrado</button></td>
                    @endif
                    @if(json_decode($info->miercoles) !== 'Cerrado')
                    <td><button class="btn btn-success">Abierto</button></td>
                    @else
                    <td><button class="btn btn-danger" disabled>Cerrado</button></td>
                    @endif
                    @if(json_decode($info->jueves) !== 'Cerrado')
                    <td><button class="btn btn-success">Abierto</button></td>
                    @else
                    <td><button class="btn btn-danger" disabled>Cerrado</button></td>
                    @endif
                    @if(json_decode($info->viernes) !== 'Cerrado')
                    <td><button class="btn btn-success">Abierto</button></td>
                    @else
                    <td><button class="btn btn-danger" disabled>Cerrado</button></td>
                    @endif
                    @if(json_decode($info->sabado) !== 'Cerrado')
                    <td><button class="btn btn-success">Abierto</button></td>
                    @else
                    <td><button class="btn btn-danger" disabled>Cerrado</button></td>
                    @endif
                    @if(json_decode($info->domingo) !== 'Cerrado')
                    <td><button class="btn btn-success">Abierto</button></td>
                    @else
                    <td><button class="btn btn-danger" disabled>Cerrado</button></td>
                    @endif
                </tr>
                <tr>
                    <td>Apertura</td>
                    @if(json_decode($info->lunes) !== "Cerrado")
                    <td>{{$lunes[0]}}:{{$lunes[1]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->martes) !== 'Cerrado')
                    <td>{{$martes[0]}}:{{$martes[1]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->miercoles) !== 'Cerrado')
                    <td>{{$miercoles[0]}}:{{$miercoles[1]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->jueves) !== 'Cerrado')
                    <td>{{$jueves[0]}}:{{$jueves[1]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->viernes) !== 'Cerrado')
                    <td>{{$viernes[0]}}:{{$viernes[1]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->sabado) !== 'Cerrado')
                    <td>{{$sabado[0]}}:{{$sabado[1]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->domingo) !== 'Cerrado')
                    <td>{{$domingo[0]}}:{{$domingo[1]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                </tr>
                <tr>
                    <td>Cierre</td>
                    @if(json_decode($info->lunes) !== 'Cerrado')
                    <td>{{$lunes[2]}}:{{$lunes[3]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->martes) !== 'Cerrado')
                    <td>{{$martes[2]}}:{{$martes[3]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->miercoles) !== 'Cerrado')
                    <td>{{$miercoles[2]}}:{{$miercoles[3]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->jueves) !== 'Cerrado')
                    <td>{{$jueves[2]}}:{{$jueves[3]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->viernes) !== 'Cerrado')
                    <td>{{$viernes[2]}}:{{$viernes[3]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->sabado) !== 'Cerrado')
                    <td>{{$sabado[2]}}:{{$sabado[3]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->domingo) !== 'Cerrado')
                    <td>{{$domingo[2]}}:{{$domingo[3]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                </tr>
            </tbody>
        </table>
        <div class="text-center">
            <a href="{{ route('trabajador.disp') }}" class="btn btn-success">volver</a>
            <a href="{{ route('trabajador.disp-horaria-edit', ['id' => $info->idTrabajador]) }}"><button class="btn btn-warning">Modificar &nbsp;<i class="fa-solid fa-pen-to-square"></i></button></a>
        </div>
    </div>
</div>



<div class="DisponibilidadTable custom-hide">
    <div>
        <h1>Horario de atención</h1>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miercoles</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Estado</td>
                    @if(json_decode($info->lunes) !== "Cerrado")
                    <td><button class="btn btn-success">Abierto</button></td>
                    @else
                    <td><button class="btn btn-danger" disabled>Cerrado</button></td>
                    @endif
                    @if(json_decode($info->martes) !== 'Cerrado')
                    <td><button class="btn btn-success">Abierto</button></td>
                    @else
                    <td><button class="btn btn-danger" disabled>Cerrado</button></td>
                    @endif
                    @if(json_decode($info->miercoles) !== 'Cerrado')
                    <td><button class="btn btn-success">Abierto</button></td>
                    @else
                    <td><button class="btn btn-danger" disabled>Cerrado</button></td>
                    @endif
                </tr>
                <tr>
                    <td>Apertura</td>
                    @if(json_decode($info->lunes) !== "Cerrado")
                    <td>{{$lunes[0]}}:{{$lunes[1]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->martes) !== 'Cerrado')
                    <td>{{$martes[0]}}:{{$martes[1]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->miercoles) !== 'Cerrado')
                    <td>{{$miercoles[0]}}:{{$miercoles[1]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif

                </tr>
                <tr>
                    <td>Cierre</td>
                    @if(json_decode($info->lunes) !== 'Cerrado')
                    <td>{{$lunes[2]}}:{{$lunes[3]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->martes) !== 'Cerrado')
                    <td>{{$martes[2]}}:{{$martes[3]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->miercoles) !== 'Cerrado')
                    <td>{{$miercoles[2]}}:{{$miercoles[3]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                </tr>
            </tbody>
        </table>


        <table class="DisponibilidadTable2" style="margin-top: 5vh;">
            <thead>
                <tr>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Sabado</th>
                    <th>Domingo</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    @if(json_decode($info->jueves) !== 'Cerrado')
                    <td><button class="btn btn-success">Abierto</button></td>
                    @else
                    <td><button class="btn btn-danger" disabled>Cerrado</button></td>
                    @endif
                    @if(json_decode($info->viernes) !== 'Cerrado')
                    <td><button class="btn btn-success">Abierto</button></td>
                    @else
                    <td><button class="btn btn-danger" disabled>Cerrado</button></td>
                    @endif
                    @if(json_decode($info->sabado) !== 'Cerrado')
                    <td><button class="btn btn-success">Abierto</button></td>
                    @else
                    <td><button class="btn btn-danger" disabled>Cerrado</button></td>
                    @endif
                    @if(json_decode($info->domingo) !== 'Cerrado')
                    <td><button class="btn btn-success">Abierto</button></td>
                    @else
                    <td><button class="btn btn-danger" disabled>Cerrado</button></td>
                    @endif
                </tr>
                <tr>
                    @if(json_decode($info->jueves) !== 'Cerrado')
                    <td>{{$jueves[0]}}:{{$jueves[1]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->viernes) !== 'Cerrado')
                    <td>{{$viernes[0]}}:{{$viernes[1]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->sabado) !== 'Cerrado')
                    <td>{{$sabado[0]}}:{{$sabado[1]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->domingo) !== 'Cerrado')
                    <td>{{$domingo[0]}}:{{$domingo[1]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                </tr>
                <tr>
                    @if(json_decode($info->jueves) !== 'Cerrado')
                    <td>{{$jueves[2]}}:{{$jueves[3]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->viernes) !== 'Cerrado')
                    <td>{{$viernes[2]}}:{{$viernes[3]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->sabado) !== 'Cerrado')
                    <td>{{$sabado[2]}}:{{$sabado[3]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                    @if(json_decode($info->domingo) !== 'Cerrado')
                    <td>{{$domingo[2]}}:{{$domingo[3]}}</td>
                    @else
                    <td> --.-- </td>
                    @endif
                </tr>

            </tbody>
        </table>
        <div>
            <h1>Turnos de cada: {{ $lapsos }} minutos.</h1>
        </div>
        <div class="buttonsCel text-center">
            <a href="{{ route('trabajador.disp') }}" class="btn btn-success">volver</a>
            <a href="{{ route('trabajador.disp-horaria-edit', ['id' => $info->idTrabajador]) }}"><button class="btn btn-warning">Modificar &nbsp;<i class="fa-solid fa-pen-to-square"></i></button></a>
        </div>
    </div>
</div>
@endsection