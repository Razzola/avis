<div class="text-center">
    <a href="javascript:history.back()"><< Back</a> ||
    <a  href="index.php?p=work-setup">Go to Work setup >></a>
    <button class="btn btn-primary hidden-print" onclick="printArea('gantt-container')"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
</div>
<div class='col-sm-12' id="gantt-container">
     <?php
        include "view/widgets/overall-gantt.php";
    ?>
</div>
<div class="text-center">
    <a href="javascript:history.back()">< Back</a>
</div>
<!-- Gantt JS-->
<script src="js/gantt/jquery.fn.gantt.js"></script>
<script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="http://taitems.github.com/UX-Lab/core/js/prettify.js"></script>

