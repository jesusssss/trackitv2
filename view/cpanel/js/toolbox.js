$(document).ready(function() {
    $( "#tabs" ).tabs();

    $("#searchDomains").submit(function(e) {
        e.preventDefault();
    });

    $("#searchDomains input[type='text']").keyup(function() {
        searchDomains($(this).val());
    });
});

function searchDomains($search) {
    $("table#domains tbody tr").hide();
    $("table#domains a.domLink").each(function() {
        if($(this).data("value").indexOf($search) !== -1) {
            $(this).closest("tr").show();
        }
    });
}