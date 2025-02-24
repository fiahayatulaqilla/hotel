<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Including CSS file for styling -->
    @include('admin.css')

    <style type="text/css">
        .table_deg {
            border: 2px solid white;
            margin: auto;
            width: 80%;
            text-align: center;
            margin-top: 40px;
        }

        .th_deg {
            background-color: skyblue;
            padding: 8px;
            text-align: center;
        }

        tr {
            border: 3px solid white;
        }

        td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Including Header -->
    @include('admin.header')

    <!-- Including Sidebar -->
    @include('admin.sidebar')

    <!-- Page Content -->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <!-- You can add page title or other elements here if needed -->
            </div>
        </div>

        <!-- Table displaying room reservation details -->
        <table class="table_deg">
            <tr>
                <th class="th_deg">Room ID</th>
                <th class="th_deg">Customer Name</th>
                <th class="th_deg">Email</th>
                <th class="th_deg">Phone</th>
                <th class="th_deg">Arrival Date</th>
                <th class="th_deg">Leaving Date</th>
                <th class="th_deg">Status</th>
                <th class="th_deg">Room Title</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Image</th>
                <th class="th_deg">Delete</th>
                <th class="th_deg">Status Update</th>
            </tr>

            @foreach($data as $booking)
            <tr>
                <td>{{ $booking->room_id }}</td>
                <td>{{  $booking->name }}</td>
                <td>{{ $booking->email }}</td>
                <td>{{ $booking->phone }}</td>
                <td>{{ $booking->start_date }}</td>
                <td>{{ $booking->end_date }}</td>

                <!-- Display status dynamically based on the value -->
                <td>
                    @if ($booking->status == 'approve')
                        <span style="color: skyblue;">Approve</span>
                    @elseif ($booking->status == 'rejected')
                        <span style="color: red;">Rejected</span>
                    @elseif ($booking->status == 'waiting')
                        <span style="color: yellow;">Waiting</span>
                    @else
                        <span style="color: grey;">Unknown</span>
                    @endif
                </td>

                <td>{{ $booking->room->room_title }}</td>
                <td>{{ $booking->room->price }}</td>
                <td>
                    <img style="width: 200px;" src="/room/{{ $booking->room->image }}">
                </td>
                <td>
                    <a onclick="return confirm('Are you sure to delete this');" class="btn btn-danger" href="{{url ('delete_booking', $booking->id) }}">Delete</a>
                </td>
                
                <td>
                    <span style="padding-bottom: 10px"> 
                        <a class="btn btn-success" href="{{ url('approve_book', $booking->id)}}">Approve</a>
                    </span>
                    <a class="btn btn-warning" href="{{ url('reject_book', $booking->id)}}">Rejected</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- Including Footer -->
    @include('admin.footer')
</body>
</html>
