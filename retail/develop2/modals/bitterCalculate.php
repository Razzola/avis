<div class="modal fade" id="bitterCalculate" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $converter?></h4>
        </div>
        <div class="modal-body">
	        <div class="panel-body">
		        <div class="form-group  col-xs-12 col-sm-3">
		        	<label>AAU recipe</label><input id="aau" class="form-control" value="" onchange="getGrams()">
		        </div>	
		        <div class="form-group  col-xs-12 col-sm-3">
		        	<label>Alfa Acid Hop</label><input id="aah" class="form-control" value="" onchange="getGrams()">
		        </div>	
		        <div class="form-group  col-xs-12 col-sm-3">
		        	<label>Liter</label><input id="lt" class="form-control" value="" onchange="getGrams()">
		        </div>
		        <div class="form-group col-xs-12 col-sm-3">
		        	<label>Grams</label><input id="grams" class="form-control" value="">
	        	</div>
	        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
 </div>