    <!-- contact -->
    <form method="post" id="contactform">
      <div class="modal fade" id="contact" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">&times;</button>
            <h3 class="dialog_header">Contact Us</h3>
          </div> <!-- /modal header -->
          <div class="modal-body">
            <div id="contactmessage">
              <!-- message from php file -->    
            </div>
             <div class="form-group">
              <label for="contactemail">Email</label>
              <input class="form-control" type="email" name="email" maxlength="50" id="contactemail">
            </div><!-- /modal body -->
            
            <div class="form-group">
              <label for="contactemail">Ask your question here, and we'll get back to you as soon as possible.</label>
              <textarea class="form-control" rows="10" name="text"  id="contacttext"></textarea>
            </div><!-- /modal body -->

            
          <div class="modal-footer">
            <input class="btn btn-success" name="contact" type="submit" value="Submit">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div><!-- /modal footer -->
        </div> <!-- /modal content -->
       </div> <!-- /modal -->
        </div>
      </div>
    </form> <!-- / -->