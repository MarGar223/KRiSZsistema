@extends('index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 bg-primary">
                a
            </div>
            <div class="col-8 me-4 bg-primary">
                {{ print_r($list) }}
                <table class="table table-success p-4 mt-4 w-100">
                    <thead>
                        <td id="CalMon">Mon</td>
                        <td>Tue</td>
                        <td>Wed</td>
                        <td>Thu</td>
                        <td>Fri</td>
                        <td>Sat</td>
                        <td>Sun</td>
                    </thead>
                    <tbody>





                        @for ($i = 1; $i <= 5; $i++)

                            <tr>
                                @for ($j = 1; $j <= 7; $j++)
                                    <td>
                                        @if ($pirmas <= count($list)-1)

                                        {{$list[1]->day}}
                                        {{-- {{$list[$pirmas++]}} --}}


                                            {{-- @for ($pirmas; $pirmas < count($list); $pirmas++)
                                                {{$list[$pirmas]}}
                                            @endfor --}}
                                        @endif
                                    </td>
                                @endfor
                            </tr>
                        @endfor



                    </tbody>
                </table>
            </div>
        </div>
        <div>
        @endsection
