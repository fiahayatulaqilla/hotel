<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style type="text/css">
    
        .table_deg
        {
          border: 2px solid white;
          margin: auto;
          width: 80%;
          text-align: center;
          margin-top: 40px;
        }
    
        .th_deg
        {
          background-color: skyblue;
          padding: 15px;
          text-align: center;
        }
    
        tr
        {
          border: 3px solid white;
        }
    
        td
        {
          padding: 10px;
          text-align: center;
        }
        </style>

  </head>
  <body>
    @include('admin.header')

        @include('admin.sidebar')

      <!-- Sidebar Navigation end-->

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">


          </div>
        </div>
      </div>


      <table class="table_deg">

        <tr>
          <th class="th_deg">Room_id</th>
          <th class="th_deg">Customer name</th>
          <th class="th_deg">Email</th>
          <th class="th_deg">Phone</th>
          <th class="th_deg">Arrival Date</th>
          <th class="th_deg">Leaving Date</th>
          
        </tr>

        <tr>
          <td>ABS</td>
          <td>ABS</td>
          <td>ABS</td>
          <td>ABS</td>
          <td>ABS</td>
          <td>ABS</td>

        </tr>

        

      </table>
   
        @include('admin.footer')


  </body>
</html>