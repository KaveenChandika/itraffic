
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

