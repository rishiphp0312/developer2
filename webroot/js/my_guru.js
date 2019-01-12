$(function() {
    $('.policydependentFields').hide();
    $('#policyType').change(function(){
        if($('#policyType').val() == 'Life') {
			$('.policydependentFields').hide();
            $('#LifeDiv').show(); 
        } else if ($('#policyType').val() == 'Liability/Umbrella') {
			$('.policydependentFields').hide();
			$('#UmbrellaDiv').show();
        } else {
			$('.policydependentFields').hide();
        }
    });
});