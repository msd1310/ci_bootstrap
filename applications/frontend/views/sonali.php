<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Autocomplete - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"></link> -->
  <script>
  $(function() {


$("#tags").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: "<?php  echo site_url('tablelist/get_json_record'); ?>",
            type: 'POST',
            dataType: "json",
            data:{ search : $('#tags').val() },
            success: function (data) {
            	//var data = JSON.parse(data);
					/*$.each(data, function (index, value) {
				        //alert(value.noplate);
				        return {
                            		label: value.pid,
                                    value: value.noplate
                                   };
				    });*/
        response($.map(data, function(v,i){
                        return {
                            		label: v.noplate,
                                    value: v.pid
                                   };
                    }));
	
				        
                 
     		}   
    	});
       		 },
    select:function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
        $("#tags_hidden").val(ui.item.value);
        //$("#selected-customer").val(ui.item.label);
    },
    focus: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
    }
});
  
   

    /*$( "#tags" ).autocomplete({
      source: availableTags
  	});*/
});
  </script>
</head>
<body>
 
<div class="ui-widget">
  <label for="tags">Tags: </label>
  <input id="tags" name="tags">
  <input id="tags_hidden" name="tags_hidden">
  <p id=”ans”></p>
 
</div>
 
 
</body>
</html>