$(function () {
    streetsLoad();
    $('#district_id').change(streetsLoad);

    $('button[type="reset"]').click(function (e) {
        e.preventDefault();
        this.form.reset();
        streetsLoad();
    });
});

/**
 * Loads streets of selected district and replaces options in streets select
 */
function streetsLoad () {
    var districtSelect = $('#district_id');
    var streetSelect = $('#street_id');
    var submitBtn = $('#submit_btn');
    var districtId = districtSelect.val();

    submitBtn.prop('disabled', true);
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: streets_json_source,
        data: 'district_id=' + districtId,
        success: function (response) {
            var options_html = '';
            for (var street in response) {
                if (response.hasOwnProperty(street)) {
                    options_html += '<option value="' + response[street]['id'] + '">' + response[street]['name'] + '</option>';
                }
            }
            streetSelect.html(options_html);
            submitBtn.prop('disabled', false);
        },
        error: function () {
            alert('Error occurs when trying to load the streets of selected district.')
        }
    });
}