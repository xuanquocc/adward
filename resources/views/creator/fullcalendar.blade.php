<!DOCTYPE html>
<html>

<head>
    <title>Jquery Fullcalandar Integration with PHP and Mysql</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.0/css/bootstrap.min.css">
    @include('library.sidebarUser')
    <link rel="stylesheet" href="{{ asset('css/dashboardCreator.css') }}">
    <link
        rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
</head>

<body>
    <div class="content-wrapper d-flex flex-row">
        @include('publicView.sidebarUser')
        <!-- Button trigger modal -->
        <div id="content">

            <!-- Modal -->

            <div class="modal fade" id="workingModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">労働時間と仕事内容
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="">
                                <label for="">コンテンツ</label>
                                <input type="text" class="form-control" id="title" name="title">
                                <span id="titleError" class="text-danger"></span>
                            </div>
                            <div class="">
                                <label for="">労働時間</label>
                                <input type="text" class="form-control" id="hours" name="hours">
                                <input type="hidden" name="projectId" value="{{ $projectId }}" id="projectId">
                                <input type="hidden" name="creatorId" value="{{ $creatorId }}" id="creatorId">
                                <input type="hidden" name="currenUserId" value="{{ $currenUserId }}" id="currenUserId">
                                <span id="titleErrorHours" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">近い</button>
                            <button type="button" id="saveBtn" class="btn btn-primary">保存</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <button type="button" style="display: none" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Launch demo modal
                </button>

                {{-- <form id="searchForm">
                    <label for="dateField">Search by Date</label>
                    <input type="date" name="dateField" id="dateField">
                    <button type="submit" id="dateBtn">Search</button>
                </form> --}}
                <div class="col-lg-4 col-6 ml-4 wrapsearch">
                    <form id="searchForm" style="display: flex;">
                        <input type="date" name="dateField" id="dateField" class="searchTerm" style="padding: 16px;">
                        <button type="submit" id="dateBtn" class="searchButton"><i
                                class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="col-md-11 offset-1 mt-5 mb-5">
                            <div id="calendar">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var isSaving = false;
            var creatorid = $('#creatorId').val();
            var currenUserId = $('#currenUserId').val();
            var working = @json($event);
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: working,
                eventRender: function(event, element, view) {
                    var startTime = moment(event.start).format('HH:mm');
                    var endTime = moment(event.end).format('HH:mm');
                    var eventTime = startTime;
                    element.find('.fc-time').text(eventTime);

                    var eventDetails = '<div class="fc-details">' +
                        '<p><b>Hours:</b> ' + event.hours + '</p>' +
                        '</div>';
                    element.find('.fc-title').append(eventDetails);
                },
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    $('#workingModal').modal('toggle')
                    $('#saveBtn').click(function() {
                        if (isSaving) {
                            return;
                        }
                        var title = $('#title').val();
                        var hours = $('#hours').val();
                        var start_date = moment(start).format('YYYY-MM-DD');
                        var end_date = moment(end).format('YYYY-MM-DD');
                        var project_id = $('#projectId').val();
                        var creator_id = $('#creatorId').val();

                        isSaving = true;
                        $.ajax({
                            url: "{{ route('calendar.store') }}",
                            type: "POST",
                            dataType: 'json',
                            data: {
                                title: title,
                                hours: hours,
                                project_id: project_id,
                                creator_id: creator_id,
                                start_date: start_date,
                                end_date: end_date
                            },
                            success: function(response) {
                                console.log(response);
                                $('#workingModal').modal('hide')
                                calendar.fullCalendar('renderEvent', response, true);
                                isSaving = false;
                            },
                            error: function(error) {
                                if (error.responseJSON.errors) {
                                    $('#titleError').html(error.responseJSON
                                        .errors
                                        .title);
                                    $('#titleErrorHours').html(error
                                        .responseJSON
                                        .errors.title);
                                }
                            },
                        });

                    });
                    // }
                },


                eventDrop: function(event) {
                    var id = event.id;
                    var start_date = moment(event.start).format('YYYY-MM-DD');
                    var end_date = moment(event.end).format('YYYY-MM-DD');
                    $.ajax({
                        url: "{{ route('calendar.update', '') }}" + '/' + id,
                        type: "PATCH",
                        dataType: 'json',
                        data: {
                            start_date: start_date,
                            end_date: end_date
                        },
                        success: function(response) {
                            swal("Good job!", "Event Updated!", "success");
                        },
                        error: function(error) {
                            console.log(error)
                        },
                    });
                    // }
                },
                eventClick: function(event) {
                    var id = event.id;
                    if (confirm('本当に削除してもよろしいですか')) {
                        $.ajax({
                            url: "{{ route('calendar.destroy', '') }}" + '/' + id,
                            type: "DELETE",
                            dataType: 'json',
                            success: function(response) {
                                calendar.fullCalendar('removeEvents', response);
                                swal("Delete success!", "Event Deleted!", "success");
                            },
                            error: function(error) {
                                console.log(error)
                            },
                        });
                    }

                },
                selectAllow: function(event) {
                    return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1,
                        'second').utcOffset(false), 'day');
                },
            });
            $("#workingModal").on("hidden.bs.modal", function() {
                $('#saveBtn').unbind();
            });

            $('#searchForm').submit(function(event) {
                event.preventDefault();
                var date = $('#dateField').val();
                calendar.fullCalendar('gotoDate', date);
                $.ajax({
                    url: "{{ route('search', $projectId) }}",
                    method: 'POST',
                    data: {
                        date: date
                    },
                    success: function(response) {
                        calendar.fullCalendar('removeEvents');
                        $.each(response.events, function(index, event) {
                            calendar.fullCalendar('renderEvent', event, true);
                        });

                    },
                    error: function(xhr, textStatus, error) {
                        console.log(error);
                        swal("日付が見つかりません!", "Event Updated!", "error");
                    }
                });
            });
        });
    </script>
</body>

</html>
