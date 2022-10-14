<!--Form Modal -->
<div class="modal fade" id="usermodal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adding or Updating Users</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form id="addform" method="POST" enctype="multipart/form-data">
          
     
      <div class="modal-body">
      <div class="form-group">
          
         <label>Name:</label>
       
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-dark"><i class="fa-solid fa-user text-light"></i></span>
            </div>
            
            <input type="text" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" id="username" name="username">

        </div> 
      
      </div>
      
      <!--Email  -->
      
      <div class="form-group">
          
         <label>Email:</label>
       
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-dark"><i class="fa-solid fa-envelope text-light"></i></span>
            </div>
            
            <input type="email" class="form-control" placeholder="Enter your Email" autocomplete="off" required="required" id="email" name="email">

        </div> 
          
          
      </div>
      
      
      <!--Mobile -->
      
      <div class="form-group">
          
         <label>Mobile:</label>
       
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-dark"><i class="fa-solid fa-phone text-light"></i></span>
            </div>
            
            <input type="text" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required="required" id="mobile" name="mobile" maxLength="10" minLength="10">

        </div> 
          
          
      </div>
      
      <!--Photo -->
      
      <div class="form-group">
          
         <label for="userphoto">Photo:</label>
       
        <div class="input-group">
            <label class="custom-file-label" for="userphoto"><span class="input-group-text bg-dark"><i class="fa-solid fa-images text-light"></i></span></label>    
            
            <input type="file" class="custom-file-input" name="photo" id="userphoto">

        </div> 
     
      </div>

      </div>
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        
        <!--2 input fields first for adding and next for updating, deleteing or viewing profile -->
        
        <input type="hidden" name="action" value="adduser">
        <input type="hidden" name="userId" id="userId" value="">
      </div>
      
      </form>
    
    </div>
  </div>
</div>
