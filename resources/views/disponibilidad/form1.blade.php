@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="text-center tituloPagina">
    <h1>Editar Horario de atención</h1>
</div>
<div class="form1">
    <div>
        <form action="{{ route('update-disp') }}" method="POST">
            @csrf
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
                        <td> <select name="estadolunes" onchange="mostrarOcultarInput('estadolunes', 'lunesaphr', 'lunesapmin', 'lunesclhr', 'lunesclmin');">
                                @if(json_decode($info->lunes) == "Cerrado")
                                <option>Cerrado</option>
                                <option>Abierto</option>
                                @else
                                <option>Abierto</option>
                                <option>Cerrado</option>
                                @endif
                            </select></td>
                        <td> <select name="estadomartes" onchange="mostrarOcultarInput('estadomartes', 'maraphr', 'marapmin', 'marclhr', 'marclmin');">
                                @if(json_decode($info->martes) == "Cerrado")
                                <option>Cerrado</option>
                                <option>Abierto</option>
                                @else
                                <option>Abierto</option>
                                <option>Cerrado</option>
                                @endif
                            </select></td>
                        <td> <select name="estadomiercoles" onchange="mostrarOcultarInput('estadomiercoles', 'mieraphr', 'mierapmin', 'miercolesclhr', 'miercolesclmin');">
                                @if(json_decode($info->miercoles) == "Cerrado")
                                <option>Cerrado</option>
                                <option>Abierto</option>
                                @else
                                <option>Abierto</option>
                                <option>Cerrado</option>
                                @endif
                            </select></td>
                        <td> <select name="estadojueves" onchange="mostrarOcultarInput('estadojueves', 'juevesaphr', 'juevesapmin', 'juevesclhr', 'juevesclmin');">
                                @if(json_decode($info->jueves) == "Cerrado")
                                <option>Cerrado</option>
                                <option>Abierto</option>
                                @else
                                <option>Abierto</option>
                                <option>Cerrado</option>
                                @endif
                            </select></td>
                        <td> <select name="estadoviernes" onchange="mostrarOcultarInput('estadoviernes', 'viernesaphr', 'viernesapmin', 'viernesclhr', 'viernesclmin');">
                                @if(json_decode($info->viernes) == "Cerrado")
                                <option>Cerrado</option>
                                <option>Abierto</option>
                                @else
                                <option>Abierto</option>
                                <option>Cerrado</option>
                                @endif
                            </select></td>
                        <td> <select name="estadosabado" onchange="mostrarOcultarInput('estadosabado', 'sabadoaphr', 'sabadoapmin', 'sabadoclhr', 'sabadoclmin');">
                                @if(json_decode($info->sabado) == "Cerrado")
                                <option>Cerrado</option>
                                <option>Abierto</option>
                                @else
                                <option>Abierto</option>
                                <option>Cerrado</option>
                                @endif
                            </select></td>
                        <td> <select name="estadodomingo" onchange="mostrarOcultarInput('estadodomingo', 'domingoaphr', 'domingoapmin', 'domingoclhr', 'domingoclmin');">
                                @if(json_decode($info->domingo) == "Cerrado")
                                <option>Cerrado</option>
                                <option>Abierto</option>
                                @else
                                <option>Abierto</option>
                                <option>Cerrado</option>
                                @endif
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Apertura</td>
                        <td>
                            <select name="lunesaphr">
                                @if(json_decode($info->lunes) !== "Cerrado")
                                <option>{{json_decode($info->lunes)[0]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="lunesapmin">
                                @if(json_decode($info->lunes) !== "Cerrado")
                                <option>{{json_decode($info->lunes)[1]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>30</option>
                            </select>
                        </td>

                        <td>
                            <select name="maraphr">
                                @if(json_decode($info->martes) !== "Cerrado")
                                <option>{{json_decode($info->martes)[0]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="marapmin">
                                @if(json_decode($info->martes) !== "Cerrado")
                                <option>{{json_decode($info->martes)[1]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>30</option>
                            </select>
                        </td>

                        <td>
                            <select name="mieraphr">
                                @if(json_decode($info->miercoles) !== "Cerrado")
                                <option>{{json_decode($info->miercoles)[0]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="mierapmin">
                                @if(json_decode($info->miercoles) !== "Cerrado")
                                <option>{{json_decode($info->miercoles)[1]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>30</option>
                            </select>
                        </td>

                        <td>
                            <select name="juevesaphr">
                                @if(json_decode($info->jueves) !== "Cerrado")
                                <option>{{json_decode($info->jueves)[0]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="juevesapmin">
                                @if(json_decode($info->jueves) !== "Cerrado")
                                <option>{{json_decode($info->jueves)[1]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>30</option>
                            </select>
                        </td>

                        <td>
                            <select name="viernesaphr">
                                @if(json_decode($info->viernes) !== "Cerrado")
                                <option>{{json_decode($info->viernes)[0]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="viernesapmin">
                                @if(json_decode($info->viernes) !== "Cerrado")
                                <option>{{json_decode($info->viernes)[1]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>30</option>
                            </select>
                        </td>

                        <td>
                            <select name="sabadoaphr">
                                @if(json_decode($info->sabado) !== "Cerrado")
                                <option>{{json_decode($info->sabado)[0]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="sabadoapmin">
                                @if(json_decode($info->sabado) !== "Cerrado")
                                <option>{{json_decode($info->sabado)[1]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>30</option>
                            </select>
                        </td>
                        <td>
                            <select name="domingoaphr">
                                @if(json_decode($info->domingo) !== "Cerrado")
                                <option>{{json_decode($info->domingo)[0]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="domingoapmin">
                                @if(json_decode($info->domingo) !== "Cerrado")
                                <option>{{json_decode($info->domingo)[1]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>30</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Cierre</td>
                        <td>
                            <select name="lunesclhr">
                                @if(json_decode($info->lunes) !== "Cerrado")
                                <option>{{json_decode($info->lunes)[2]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="lunesclmin">
                                @if(json_decode($info->lunes) !== "Cerrado")
                                <option>{{json_decode($info->lunes)[3]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>30</option>
                            </select>
                        </td>

                        <td>
                            <select name="marclhr">
                                @if(json_decode($info->martes) !== "Cerrado")
                                <option>{{json_decode($info->martes)[2]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="marclmin">
                                @if(json_decode($info->martes) !== "Cerrado")
                                <option>{{json_decode($info->martes)[3]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>30</option>
                            </select>
                        </td>

                        <td>
                            <select name="miercolesclhr">
                                @if(json_decode($info->miercoles) !== "Cerrado")
                                <option>{{json_decode($info->miercoles)[2]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="miercolesclmin">
                                @if(json_decode($info->miercoles) !== "Cerrado")
                                <option>{{json_decode($info->miercoles)[3]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>30</option>
                            </select>
                        </td>

                        <td>
                            <select name="juevesclhr">
                                @if(json_decode($info->jueves) !== "Cerrado")
                                <option>{{json_decode($info->jueves)[2]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="juevesclmin">
                                @if(json_decode($info->jueves) !== "Cerrado")
                                <option>{{json_decode($info->jueves)[2]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>30</option>
                            </select>
                        </td>

                        <td>
                            <select name="viernesclhr">
                                @if(json_decode($info->viernes) !== "Cerrado")
                                <option>{{json_decode($info->viernes)[2]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="viernesclmin">
                                @if(json_decode($info->viernes) !== "Cerrado")
                                <option>{{json_decode($info->viernes)[3]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>30</option>
                            </select>
                        </td>

                        <td>
                            <select name="sabadoclhr">
                                @if(json_decode($info->sabado) !== "Cerrado")
                                <option>{{json_decode($info->sabado)[2]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="sabadoclmin">
                                @if(json_decode($info->sabado) !== "Cerrado")
                                <option>{{json_decode($info->sabado)[3]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>30</option>
                            </select>
                        </td>

                        <td>
                            <select name="domingoclhr">
                                @if(json_decode($info->domingo) !== "Cerrado")
                                <option>{{json_decode($info->domingo)[2]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="domingoclmin">
                                @if(json_decode($info->domingo) !== "Cerrado")
                                <option>{{json_decode($info->domingo)[3]}}</option>
                                <option>00</option>
                                @else
                                <option>00</option>
                                @endif
                                <option>30</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="text-center">
                <a href="{{ route('disponibilidad') }}" class="btn btn-danger">Cancelar &nbsp;<i class="fa-solid fa-circle-xmark"></i></a>
                <button type="submit" class="btn btn-success">Guardar &nbsp;<i class="fa-solid fa-square-check"></i></button>
            </div>
        </form>
    </div>
    <div>
        <form action="{{ route('update-disp-todas') }}" method="POST">
            @csrf
            <table id="disp-horaria-todas">
                <thead>
                    <tr>
                        <th colspan="2">Todas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2"> <select name="estadotodas" onchange="mostrarOcultarInput('estadotodas', 'todashr', 'todasmin', 'todasclhr', 'todasclmin');">
                                <option>Cerrado</option>
                                <option>Abierto</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td><select name="todashr">
                                <option>00</option>
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="todasmin">
                                <option>00</option>
                                <option>30</option>
                        </td>
                    </tr>
                    <tr>
                        <td><select name="todasclhr">
                                <option>00</option>
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                            </select>:
                            <select name="todasclmin">
                                <option>00</option>
                                <option>30</option>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" class="btn btn-success">Guardar&nbsp;<i class="fa-solid fa-square-check"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        mostrarOcultarInput('estadotodas', 'todashr', 'todasmin', 'todasclhr', 'todasclmin');
        mostrarOcultarInput('estadolunes', 'lunesaphr', 'lunesapmin', 'lunesclhr', 'lunesclmin');
        mostrarOcultarInput('estadomartes', 'maraphr', 'marapmin', 'marclhr', 'marclmin');
        mostrarOcultarInput('estadomiercoles', 'mieraphr', 'mierapmin', 'miercolesclhr', 'miercolesclmin');
        mostrarOcultarInput('estadojueves', 'juevesaphr', 'juevesapmin', 'juevesclhr', 'juevesclmin');
        mostrarOcultarInput('estadoviernes', 'viernesaphr', 'viernesapmin', 'viernesclhr', 'viernesclmin');
        mostrarOcultarInput('estadosabado', 'sabadoaphr', 'sabadoapmin', 'sabadoclhr', 'sabadoclmin');
        mostrarOcultarInput('estadodomingo', 'domingoaphr', 'domingoapmin', 'domingoclhr', 'domingoclmin');
    });
</script>
@endsection