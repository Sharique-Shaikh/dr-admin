/* $(document).ready(function() {
    $('#example').DataTable({
		"paging":   false,
        "info":     false,
		"filter": false,
		columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0,
			'checkboxes': {
				'selectRow': true
			 }
        } ],
        select: {
            style:    'multi',
            /* selector: 'td:first-child' 
        },
        /* order: [[ 1, 'asc' ]] 
	});
} );

 */


$(document).ready(function (){
	var table = $('#example').DataTable({
		
		"paging":   false,
        "info":     false,
		"filter": false,
	   'columnDefs': [{
		  'targets': 0,
		  'searchable': false,
		  'orderable': false,
		  'className': 'dt-body-center',
		  'render': function (data, type, full, meta){
			  return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
		  }
	   }],
	   scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        
        fixedColumns:   {
			leftColumns: 1,
            leftColumns: 2,
            rightColumns: 1
        },
	   'order': [[1, 'asc']]
	});
 
	
 
	
 
 });







 /* $(".hide-list").click(function(){
          
    $(".customers-body .transaction-item").toggleClass( "hide-row");


    if (!$(".customers-body .transaction-item").hasClass("hide-row")) {
    $(".hide-list").text("Show Less Transactions");
    
    } else {
    $(".hide-list").text("View All Transactions");
    
    }
}); */