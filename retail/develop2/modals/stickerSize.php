<div class="modal fade" id="StickerSize" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $converter?></h4>
        </div>
	        <div class="modal-body">
		        <div class="panel-body">
		        	<div class="form-group col-xs-12 col-sm-12">
			        	<label>Time</label>
	                    <select class="form-control" id="stickersize" name="stickersize" onchange="setLinkToSticker()">
		                   	<option value="">Select size</option>
		                   	<option value="100">1l</option>
		                   	<option value="75">75cl</option>
							<option value="50">50cl</option>
							<option value="33">33cl</option>
		                </select>
		        	</div>
			        <div class="form-group col-xs-12 col-sm-12">
                		<a id="linkToSticker" href="sticker.php?uid=<?php echo $uid; ?>" class="btn btn-default"><?php echo $apply;?> - Size</a>
		        	</div>
		        </div>
		    </div>
		 </div>
    </div>
 </div>