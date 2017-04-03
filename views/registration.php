<!-- sign up form -->
    <form method="post" id="registerform">
      <div class="modal fade" id="register" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">&times;</button>
            <h3 class="dialog_header">Sign up today to start using Webnote!</h3>
          </div> <!-- /modal header -->
          <div class="modal-body">
            <div id="signupmessage">
              <!-- sign up message from php file -->    
            </div>
             <div class="form-group">
              <label for="username" >Username</label>
              <input class="form-control" type="text" name="username" maxlength="30" id="username">
            </div>
             <div class="form-group">
              <label for="email">Email</label>
              <input class="form-control" type="email" name="email"  maxlength="50" id="email">
            </div>
             <div class="form-group">
              <label for="password" >Password</label>
              <input class="form-control" type="password" name="password" maxlength="30" id="password">
            </div>
             <div class="form-group">
              <label for="password2" >Confirm Password</label>
              <input class="form-control" type="password" name="password2"  maxlength="30" id="password2">
            </div>
          </div><!-- /modal body -->
          <div class="modal-footer">
            <input class="btn btn-success" name="signup" type="submit" value="Sign Up">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div><!-- /modal footer -->
        </div> <!-- /modal content -->
        </div> <!-- /modal dialog -->
       </div> <!-- /modal -->
    </form> <!-- /signup form -->