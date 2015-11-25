<html>

<link rel='stylesheet' href='css/jquery-ui-custom.css'/>
<link rel='stylesheet' href='css/ui.jqgrid.css'/>
<script src='js/jquery-1.9.0.min.js'></script>
<script src='js/grid.locale-en.js'></script>
<script src='js/jquery.jqGrid.min.js'></script>
<head>
<title>jqGrid php tutorial</title>
</head>
<body>
	<table id="mytable"></table>
	<div id="noplate" ></div>


  <script>
	   jQuery("#mytable").jqGrid({
	   url:'server.php?q=2',
	   datatype: "json",
	   colNames:['Receipt No','Vehicle No', 'Status', 'Update'],
	   colModel:[ {name:'Receipt No',index:'Receipt No', width:30,classes: 'cvteste'},
	   {name:'Vehicle No',index:'Vehicle No', width:90,classes: 'cvteste'},
	   {name:'Status',index:'Status', width:80,classes: 'cvteste'},
	   {name:'Update',index:'Update', width:135,align:"center",classes: 'cvteste'}
    ],
	   rowNum:10,
	   rowList:[10,20,30],
	   pager: '#noplate',
	   sortname: 'Receipt No',
	   recordpos: 'left',
	   viewrecords: true,
	   sortorder: "asc",
	   height: '100%'
	   });

	</script>
</body>
</html>
