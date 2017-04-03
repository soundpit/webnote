 <!-- login Modal -->
   <!-- login form -->
    <form method="post" id="loginform">
      <div class="modal fade" id="login" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">&times;</button>
            <h3 class="dialog_header">Login</h3>
          </div> <!-- /modal header -->
          <div class="modal-body">
            <div id="loginmessage">
              <!-- login message from php file -->    
            </div>
             <div class="form-group">
              <label for="loginemail">Email</label>
              <input class="form-control" type="email" name="loginemail"  maxlength="50" id="loginemail">
            </div>
             <div class="form-group">
              <label for="loginpassword" >Password</label>
              <input class="form-control" type="password" name="loginpassword" maxlength="30" id="loginpassword">
            </div>
            
            <!-- remember me checkbox -->
            <div class="checkbox">
              <label>
                <input type="checkbox" name="rememberme" id="rememberme">
                Remember me    
              </label>
              <!-- forgot password link -->
              <a class="pull-right" style="cursor:pointer;" data-dismiss="modal" data-target="#forgotpassword" data-toggle="modal">Forgot Password?</a>
            </div>
            
             </div><!-- /modal body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="#register" data-toggle="modal">Register</button>
            <input class="btn btn-success" name="login" type="submit" value="Login">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div><!-- /modal footer -->
        </div> <!-- /modal content -->
        </div><!-- /modal dialog -->
       </div> <!-- /modal -->
    </form> <!-- /login form -->