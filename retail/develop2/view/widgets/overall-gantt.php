
<div class="contain">

    <div class="gantt"></div>
</div>
<script>

    $(function() {



        $(".gantt").gantt({
            source: "source/work-setup.php",
            scale: "week",
            minScale: "hours",
            navigate: "scroll"
        });

        //$(".gantt").popover({
        //    selector: ".bar",
        //    title: "I'm a popover",
        //    content: "And I'm the content of said popover.",
        //    trigger: "hover"
        //});

    });

</script>
<!-- style type="text/css">
			body {
				font-family: Helvetica, Arial, sans-serif;
				font-size: 13px;
				padding: 0 0 50px 0;
			}
			.contain {
				width: 800px;
				margin: 0 auto;
			}
			h1 {
				margin: 40px 0 20px 0;
			}
			h2 {
				font-size: 1.5em;
				padding-bottom: 3px;
				border-bottom: 1px solid #DDD;
				margin-top: 50px;
				margin-bottom: 25px;
			}
			table th:first-child {
				width: 150px;
			}
		</style -->