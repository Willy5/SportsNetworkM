$('#thefireflies_sportbundle_playerdetail_public').click(function() {
    var $this = $(this);
    // $this will contain a reference to the checkbox   
    if ($this.is(':checked')) {
        $('.for-guest').hide(500);
    } else {
        $('.for-guest').show(500);
    }
});
$( document ).ready(function() {
    $('.pre-hidden').show();
});