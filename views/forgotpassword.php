    <!-- forgot password -->
    <form method="post" id="forgotpasswordform">
      <div class="modal fade" id="forgotpassword" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">&times;</button>
            <h3 class="dialog_header">Forgot Password? Enter your email address:</h3>
          </div> <!-- /modal header -->
          <div class="modal-body">
            <div id="forgotpasswordmessage">
              <!-- forgotpassword message from php file -->    
            </div>
             <div class="form-group">
              <label for="forgotpasswordmail" class="sr-only">Email:</label>
              <input class="form-control" type="email" name="forgotpasswordemail" placeholder="Email" maxlength="50" id="forgotpasswordemail">
              </div><!-- /modal body -->
          <div class="modal-footer">
            <input class="btn btn-success" name="forgotpassword" type="submit" value="Submit">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div><!-- /modal footer -->
        </div> <!-- /modal content -->
       </div> <!-- /modal -->
        </div>
      </div>
    </form> <!-- /forgot password -->