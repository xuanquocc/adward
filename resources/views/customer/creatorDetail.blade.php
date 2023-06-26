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
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans);

        body {
            background: #f2f2f2;
            font-family: 'Open Sans', sans-serif;
        }

        .search {
            width: 100%;
            position: relative;
            display: flex;
            justify-content: center;

        }

        .searchTerm {
            width: 100%;
            border: 3px solid #00B4CC;
            border-right: none;
            padding: 5px;
            height: 36px;
            border-radius: 5px 0 0 5px;
            outline: none;
            color: #9DBFAF;
        }

        .searchTerm:focus {
            color: #00B4CC;
        }

        .searchButton {
            width: 40px;
            height: 36px;
            border: 1px solid #00B4CC;
            background: #00B4CC;
            text-align: center;
            color: #fff;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-size: 20px;
        }

        /*Resize the wrap to see the search bar change!*/
        .wrap {
            width: 60% !important;
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
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
                            <h5 class="modal-title" id="exampleModalLabel">労働時間と仕事内容</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="wrap">
                                <label for="">コンテンツ</label>
                                <input type="text" class="form-control" id="title" name="title">
                                <span id="titleError" class="text-danger"></span>
                            </div>
                            <div class="wrap">
                                <label for="">労働時間</label>
                                <input type="text" class="form-control" id="hours" name="hours">
                                <input type="hidden" name="projectId" value="{{ $projectId }}" id="projectId">
                                <input type="hidden" name="creatorId" value="{{ $creatorId }}" id="creatorId">

                                <span id="titleErrorHours" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <button type="button" style="display: none" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Launch demo modal
                </button>
                <h1 class="mt-4">{{ $creatorName }}</h1>
                <div class="wrap mt-4">
                    <form class="search" id="searchForm">
                        <input type="date" class="searchTerm" name="dateField" id="dateField"
                            placeholder="What are you looking for?">
                        <button type="submit" id="dateBtn" class="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                </div>
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
                        console.log(response.events);
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
