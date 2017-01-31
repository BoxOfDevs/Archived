$('form').submit(function(event, doRealSubmit) {
    // this executes on the second pass
    if (doRealSubmit) {
        
        return true; 
    }

    // this executes on the first pass
    $.ajax({
        url: 'POST.php',
        type: 'GET',
        data: $(this).serialize(),
        success: function(data) {
            // trigger 'submit' event again, but pass the doRealSubmit flag
            $('form').trigger('submit', [true]);
        }
    });

    return false;
});