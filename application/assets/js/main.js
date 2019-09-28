
// function openNav() {
//   document.getElementById("mySidenav").style.width = "250px";
//   document.getElementById("main").style.marginLeft = "250px";
// }

// function closeNav() {
//   document.getElementById("mySidenav").style.width = "0";
//   document.getElementById("main").style.marginLeft= "0";
//   document.getElementById("kk").style.marginLeft= "0";
// }

$(document).ready(function() {
  // alert( "ready!" );
  get_users();
  get_user_belongs_vehicles();
});

function get_users(){
  $.ajax({
    url:'getUsers',
    type:'POST',
    success:function(data){
      var result = JSON.parse(data);
      var length = Object.keys(result['users']).length;
      var count = 1;
      $('#driverDiv').empty();
      for(var i=0; i<length; i++){
        var type = result['users'][i]['u_type'];
        var value = "";
        if(type ==1){
          value = 'Driver';
        }else{
          value = 'Passengers';
        }
        console.log(result['users'][0]['u_name'])
        $('#driverDiv').append('<tr><td>'+count+'</td><td>'+result['users'][i]['u_name']+'</td><td>'+result['users'][i]['u_mobile']+'</td><td>'+result['users'][i]['u_tel']+'</td><td>'+result['users'][i]['u_address']+'</td><td>'+result['users'][i]['u_email']+'</td><td>'+value+'</td></tr>');

        count++;
      }
    }
  });
}

function get_user_belongs_vehicles(){
  $.ajax({
    url:'get_user_belongs_vehicles',
    type:'POST',
    success:function(data){
      var result = JSON.parse(data);
      console.log(result);
      var length = Object.keys(result['vehicleUsers']).length;
      var count = 1;
      $('#vehicleBelongsUserDiv').empty();
      for(var i=0; i<length; i++){
        var type = result['vehicleUsers'][i]['u_type'];
        var value = "";
        if(type ==2){
          value = 'Driver';
        }else{
          value = 'Passengers';
        }
        $('#vehicleBelongsUserDiv').append('<tr><td>'+count+'</td><td>'+result['vehicleUsers'][i]['v_number']+'</td><td>'+result['vehicleUsers'][i]['u_name']+'</td><td>'+result['vehicleUsers'][i]['v_type']+'</td><td>'+result['vehicleUsers'][i]['latitude']+'</td><td>'+result['vehicleUsers'][i]['longtitude']+'</td></tr>');

        count++;
      }
    }
  });
}

function login_authetication(){
  var username = $('#username').val();
  var password = $('#password').val();

  $.ajax({
      url:'UserController/login_auth',
      type:'POST',
      data:{
        username,
        password,
      },
      success:function(data){
        var status = JSON.parse(data);
        console.log(status['status']);  
        if(status['status']){
          alertify.success('You are successfully logged here', 'Confirm Message', function(){ window.location.href = "http://127.0.0.1/itraffic/UserController/home";}
                , function(){ alertify.error('Cancel')});
          
        }else{
          alertify.success('Login Failed', 'Confirm Message', function(){ window.location.reload();}
                , function(){ alertify.error('Cancel')});
          // window.location.reload();
        }
       
      }
  })
}

