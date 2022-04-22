@extends('index')

@section('content')
    <div class="container">
        <div class="p-2 flex-shrink-0 bd-highlight">
            <button class="btn btn-success" id="btn-add">
                Add Todo
            </button>
        </div>
        <table class="table table-stripped table-primary">
            <thead>
                <tr>
                    <th scope="col">Rezervacija atlikta</th>
                    <th scope="col">rezervuotojas</th>
                    <th scope="col">zona</th>
                    <th scope="col">Rezervuota data</th>
                    <th scope="col">Pradžios laikas</th>
                    <th scope="col">Pabaigos laikas</th>
                    <th scope="col">Asmenų skaičius</th>
                </tr>
            </thead>
            <tbody id="todos-list" name="todos-list">
                @foreach ($reservations as $reservation)
                    <tr id="reservation{{$reservation->id}}">
                        <td>{{ $reservation->updated_at->diffForHumans() }}</td>
                        <td>{{ $reservation->user->name }}</td>
                        <td>{{ $reservation->zone->name }}</td>
                        <td>{{ $reservation->date_when }}</td>
                        <td>{{ $reservation->start_time }}</td>
                        <td>{{ $reservation->end_time }}</td>
                        <td>{{ $reservation->people_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="formModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="formModalLabel">Create Todo</h4>
                    </div>
                    <div class="modal-body">
                        <form id="myForm" name="myForm" class="form-horizontal" novalidate="">
                            @csrf
                            <label for="zone" class="form-label">Zona</label>
                            <select name="zone" id="zone" value="{{ $reservation->name }}"
                                class="form-select  shadow-sm @error('zone') border border-danger text-danger @enderror">
                                <option value="" id="zone_id" selected>
                                    {{ $reservation->zone->name }}
                                </option>
                                @foreach ($zones as $zone)
                                    @if ($reservation->zone_id == $zone->id)
                                    @else
                                        <option value="{{ $zone->id }}" id="zone_id{{ $zone->id }}">
                                            {{ $zone->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('zone')
                                <div class="fs-6 text-danger">
                                    <span>Lauką privaloma užpildyti</span>
                                </div>
                            @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Data</label>
                        <input type="date" name="date_when" id="date_when" value=""
                            class="form-control shadow-sm @error('date_when') border border-danger text-danger @enderror">
                        @error('date_when')
                            <div class="fs-6 text-danger">
                                <span>Lauką privaloma užpildyti</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="start_time" class="form-label">Laikas nuo</label>
                        <input type="time" name="start_time" id="start_time" value=""
                            class="form-control shadow-sm @error('start_time') border border-danger text-danger @enderror">
                        @error('start_time')
                            <div class="fs-6 text-danger">
                                <span>Lauką privaloma užpildyti</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="end_time" class="form-label">laikas iki</label>
                        <input type="time" name="end_time" id="end_time" value=""
                            class="form-control shadow-sm @error('end_time') border border-danger text-danger @enderror">
                        @error('end_time')
                            <div class="fs-6 text-danger">
                                <span>Lauką privaloma užpildyti</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">

                        <label for="people_count" class="form-label">Skaicius
                            asmenu</label>
                        <input type="number" name="people_count" id="people_count"
                            value=""
                            class="form-control shadow-sm @error('end_time') border border-danger text-danger @enderror">
                        @error('people_count')
                            <div class="fs-6 text-danger">
                                <span>Lauką privaloma užpildyti</span>
                            </div>
                        @enderror
                    </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes
                    </button>
                    <input type="hidden" id="todo_id" name="todo_id" value="0">
                </div>
            </form>
            </div>
            </div>
        </div>
    </div>


    <script>
        jQuery(document).ready(function($) {
            //----- Open model CREATE -----//
            jQuery('#btn-add').click(function() {
                jQuery('#btn-save').val("add");
                jQuery('#myForm').trigger("reset");
                jQuery('#formModal').modal('show');
            });
            // CREATE
            $("#btn-save").click(function(e) {
                $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
                e.preventDefault();
                var formData = {
                    zone: jQuery('#zone').val(),
                    date_when: jQuery('#date_when').val(),
                    start_time: jQuery('#start_time').val(),
                    end_time: jQuery('#end_time').val(),
                    people_count: jQuery('#people_count').val(),

                };
                var state = jQuery('#btn-save').val();
                var type = "POST";
                var todo_id = jQuery('#reservation').val();
                var ajaxurl = 'test';
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        var todo = '<tr id="reservation' + 123123 + '"><td>' + data.zone + '</td><td>' + data.date_when + '</td><td>' + data.start_time + '</td><td>' + data.end_time + '</td><td>' + data.people_count + '</td>';
                        if (state == "add") {
                            console.log('added')
                            jQuery('#todo-list').append(todo);
                        } else {
                            jQuery("#reservation" + todo_id).replaceWith(todo);
                        }
                        jQuery('#myForm').trigger("reset");
                        jQuery('#formModal').modal('hide')
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection
