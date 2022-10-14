 //function for pagination

function pagination(totalpages, currentpages){
    var pagelist="";
    if(totalpages > 1){
        currentpages=parseInt(currentpages);
        pagelist +=`<ul class="pagination justify-content-center">`;
        const prevClass = currentpages==1?"disabled":"";
        pagelist +=`<li class="page-item ${prevClass}"><a class="page-link" href="#" data-page="${currentpages-1}">Previous</a></li>`;
        
        for(let p=1;p<=totalpages;p++){
            const activeClass=currentpages==p?"active":"";
        pagelist +=`<li class="page-item ${activeClass}"><a class="page-link" href="#" data-page="${p}">${p}</a></li>`;
             }
        const nextClass = currentpages==totalpages?"disabled":"";
        pagelist +=`<li class="page-item ${nextClass}"><a class="page-link" href="#" data-page="${currentpages+1}">Next</a></li>`;
        pagelist +=`</ul>`;
    }
    $("#pagination").html(pagelist);
    
}


//function to get users from database

function getuserRow(user){
    var userRow="";
    if(user){
        const userPhoto = user.photo? user.photo : 'default-image3.png';
        userRow=` <tr>
      <td scope="row"><img src=uploads/${userPhoto}></td>
      <td>${user.name}</td>
      <td>${user.email}</td>
      <td>${user.mobile}</td>
      <td>
      <span><a href="#" class="me-3 profile" data-bs-target="#userViewModal" data-bs-toggle="modal" title="View Profile" data-id=${user.id}><i class="fa-solid fa-eye text-dark"></i> </a></span>
      <span><a href="#" class="me-3 edituser" data-bs-target="#usermodal" data-bs-toggle="modal" title="Edit" data-id=${user.id}><i class="fa-solid fa-pen-to-square text-info"></i> </a></span>
      <span><a href="#" class="me-3 deleteuser" data-bs-target="#" data-bs-toggle="modal" title="Delete" data-id=${user.id}><i class="fa-solid fa-trash-can text-danger"></i> </a></span>
      </td>
      </tr>`;
    }
    return userRow;
}


//get users function
    
    function getUsers(){
        var pageno=$("#currentpage").val();
        $.ajax({
            url: "/PHP_WORK/Complete_CRUD/ajax.php",
            type: "GET",
            dataType: "json",
            data: {page:pageno,action:'getallusers'},
            beforeSend: function(){
            console.log("waiting..."); 
            },
            
              success:function(rows){
              console.log(rows);
                  if(rows.users){
                      var userslist="";
                      $.each(rows.users, function(index, user){
                          userslist += getuserRow(user);
                          
                      });
                      $("#usertable tbody").html(userslist);
                      //pagination 
                      let totalusers=rows.count;
                      //console.log(totalusers);
                      let totalpages=Math.ceil(parseInt(totalusers)/4);
                      const currentpages=$("#currentpage").val();
                      pagination(totalpages, currentpages);
                  }
        },
            error:function(){
                console.log("Oops! Something went wrong!");
            },  
        });
    }

//Loading Document function

$(document).ready(function(){
    
         //adding users
    $(document).on("submit", "#addform",function(event){
        event.preventDefault();
        
        var msg=$("#userId").val().length > 0? "User has been updated successfully!": "New user has been added successfully";
        
        //ajax code here
        $.ajax({
            url:"/PHP_WORK/Complete_CRUD/ajax.php",
            type:"POST",
            dataType: "json",
            data: new FormData(this),
            processData: false,  
            contentType: false,
            beforeSend: function(){
                console.log("waiting...");
                //console.log("wait...Data is loading...");
                
        },
               success:function(response){
               console.log(response);
                   if(response){
                       $("#usermodal").modal("hide");
                       $("#addform")[0].reset();
                       $(".displaymessage").html(msg).fadeIn().delay(5000).fadeOut();

                       
                       getUsers();
                   }
        },
                error:function(request,error){
                console.log("Oops! Something went wrong!");
                //console.log(arguments);
                //console.log("Error"+ error);
                
            },
        });
    });
    
   
   //onclick event for pagination
    $(document).on("click", "ul.pagination li a", function(event){
        event.preventDefault();
        
        const pagenum=$(this).data("page");
        $("#currentpage").val(pagenum);
        getUsers();
        $(this).parent().siblings().removeClass("active");
        $(this).parent().addClass("active");
        
    });
    
    //onclick event for editing
   $(document).on("click","a.edituser",function(){
        var uid=$(this).data("id");
        //alert(uid);
       
       $.ajax({
            url: "/PHP_WORK/Complete_CRUD/ajax.php",
            type: "GET",
            dataType: "json",
            data: {id:uid,action:"editusersdata"},
            beforeSend: function(){
            console.log("waiting..."); 
            },
            
                success:function(rows){
                console.log(rows);
                  if(rows){
                      $("#username").val(rows.name);
                      $("#email").val(rows.email);
                      $("#mobile").val(rows.mobile);
                      $("#userId").val(rows.id);
                  }
                 
                },
                error:function(){
                console.log("Oops! Something went wrong!");
            },  
        });
    }); 
    
   
    //onclick for adding user btn
    $("#adduserbtn").on("click", function(){
       $("#addform")[0].reset();
        $("#userId").val("");
    });
    
    
    
    //onclick event for Deleting
    
    $(document).on("click","a.deleteuser",function(event){
        event.preventDefault();
        var uid=$(this).data("id");
        
        if(confirm("Are you sure you want to delete this User?")){
            $.ajax({
            url: "/PHP_WORK/Complete_CRUD/ajax.php",
            type: "GET",
            dataType: "json",
            data: {id:uid, action:"deleteuserdata"},
            beforeSend: function(){
            console.log("waiting..."); 
            },
                success:function(res){
                    if(res.deleted == 1){
                        $("#displaymessage").html("<strong>Status:</strong> User has been deleted Successfully").fadeIn().delay(4000).fadeOut();
                        getUsers();
                        console.log("done");
                    }
                },
                 error:function(){
                 console.log("Oops! Something went wrong!");
                 },  
        
            }); 
        }
    });
    
    
    //profile view
    $(document).on("click","a.profile",function(){
     var uid=$(this).data("id");
         $.ajax({
            url: "/PHP_WORK/Complete_CRUD/ajax.php",
            type: "GET",
            dataType: "json",
            data: {id:uid, action:"editusersdata"},
             success:function(user){
                  if(user){
                      const userPhoto = user.photo? user.photo : 'default-image3.png';
                      const profile=`<div class="row">
                                   <div class="col-sm-6 col-md-4">
                                   <img src="uploads/${userPhoto}" class="rounded responsive"/>
                                   </div>
                                   <div class="col-sm-6 col-md-8">
                                   <h4 class="text-primary" style="text-transform: uppercase;">${user.name}</h4>
                                   <p>
                                   <i class="fa fa-envelope" aria-hidden="true"></i> ${user.email}
                                   <br/>
                                   <i class="fa fa-phone" aria-hidden="true"></i>${user.mobile}
                                   </p>
                                   </div>
                                   </div>`;
                      $("#profile").html(profile);
                  }
              },
                error:function(){
                 console.log("Oops! Something went wrong!");
                 }, 
        
    });
    });
    
    
    //Search User Data
    $("#searchinput").on("keyup", function(){
       const searchText=$(this).val();
        console.log();
        if(searchText.length > 1){
            $.ajax({
            url: "/PHP_WORK/Complete_CRUD/ajax.php",
            type: "GET",
            dataType: "json",
            data: { searchQuery: searchText, action:"searchuser"},
             success:function(users){
                 if(users){
                 var usersList="";
                 $.each(users, function(index, user){
                     usersList +=getuserRow(user);
                 });
                 $("#usertable tbody").html(usersList);
                  $("#pagination").hide();   
                 }
             },
               error:function(){
                 console.log("Oops! Something went wrong!");
                 }, 
            });    
        } else{
            getUsers();
            $("#pagination").show();
        }
        
    });
    
   
    
    
   //alert(123);
    
  //calling getusers() function when document is loaded
    getUsers();
    
});

