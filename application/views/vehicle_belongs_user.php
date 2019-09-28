<script src="http://localhost/itraffic/assets/js/main.js"></script>
<script>
  $(document).ready(function() { 
      alertify.success('Loading Vehicle View');
    }
  );
</script>
<div class="container" style="margin:100px">

    <h3><b>Vehicle View</b></h3>
    <table class="table table-striped">
  <thead>
    <tr>
      <th stype=" font-size:20px" scope="col"><b>No</b></th>
      <th stype=" font-size:20px" scope="col"><b>Vehicle Number</b></th>
      <th stype=" font-size:20px" scope="col"><b>User</b></th>
      <th stype=" font-size:20px" scope="col"><b>Vehicle Type</b></th>
      <th stype=" font-size:20px" scope="col"><b>Latitude</b></th>
      <th stype=" font-size:20px" scope="col"><b>Longtitude</b></th>
    </tr>
  </thead>
  <tbody id="vehicleBelongsUserDiv">
    
  </tbody>
</table>
</div>