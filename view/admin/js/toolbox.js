$(document).ready(function() {
    $( "#tabs" ).tabs();

    $("#searchDomains input[type='text']").keyup(function() {
        searchPages($(this).val());
    });

    $("#pagetitle").keyup(function() {
       insertLink($(this).val());
    });

});

function searchPages($search) {
    $("table#pages tbody tr").hide();
    $("table#pages a.domLink").each(function() {
        if($(this).data("value").indexOf($search) !== -1) {
            $(this).closest("tr").show();
        }
    });
}

function insertLink($value) {
    $low = $value.toLowerCase();
    $low = $low.replace(/ /g,'-');
    $("#pagelink").val("/"+$low);
}