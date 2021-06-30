var basic = $('#demo-basic').croppie({
    viewport: {
        width: 150,
        height: 600
    },
    boundary: {
        width: 400,
        height: 400
    }
});
$('.my-image').croppie({
    enableExif: true,
    mouseWheelZoom: true,
    showZoomer: true,
    enableResize: true,
    viewport: {
        width: 200,
        height: 200,
    },
    boundary: {
        width: 300,
        height: 300
    }
});
$('.my-signature').croppie({
    enableExif: true,
    mouseWheelZoom: true,
    showZoomer: true,
    enableResize: true,
    viewport: {
        width: 200,
        height: 200,
    },
    boundary: {
        width: 300,
        height: 300
    }
});
$('#own_office_organogram_tree').jstree({
    "core" : {
        "check_callback" : true
    },
    "plugins": ["dnd","checkbox", "search"] 
});

$('#owndesignation_structure_tree_search').keyup(function(){
    $('#own_office_organogram_tree').jstree(true).show_all();
    $('#own_office_organogram_tree').jstree('search', $(this).val());
});
$('#searchPlaneField').keyup(function(){
    $('#newAudit').jstree(true).show_all();
    $('#newAudit').jstree('search', $(this).val());
});
$(".checkPasword").keyup(function(){  
    var passValue = $(this).val();
    var lowerCaseLetters = /[a-z]/g;
    var upperCaseLetters = /[A-Z]/g;
    var numbers = /[0-9]/g;
    var format = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    // Validate length
    if(passValue.length < 8){
        $('.correct-text').addClass('text-danger');
        $('.correct-text').children('i').addClass('fa-times');
        $('.correct-text').children('i').addClass('text-danger');
        $('.correct-text').removeClass('text-success');
        $('.correct-text').children('i').removeClass('text-success');
        $('.correct-text').children('i').removeClass('fa-check');
    }else{
        $('.correct-text').removeClass('text-danger');
        $('.correct-text').children('i').removeClass('fa-times');
        $('.correct-text').children('i').removeClass('text-danger');
        $('.correct-text').addClass('text-success');
        $('.correct-text').children('i').addClass('text-success');
        $('.correct-text').children('i').addClass('fa-check');
    }
     // Validate lowercase letters
    if(passValue.match(lowerCaseLetters)){
        $('.small-letter').addClass('text-success');
        $('.small-letter').children('i').addClass('fa-check');
        $('.small-letter').children('i').addClass('text-success');
        $('.small-letter').removeClass('text-danger');
        $('.small-letter').children('i').removeClass('text-danger');
        $('.small-letter').children('i').removeClass('fa-times');
    }else{
        $('.small-letter').removeClass('text-success');
        $('.small-letter').children('i').removeClass('fa-check');
        $('.small-letter').children('i').removeClass('text-success');
        $('.small-letter').addClass('text-danger');
        $('.small-letter').children('i').addClass('text-danger');
        $('.small-letter').children('i').addClass('fa-times');
    }
    // Validate capital letters
    if(passValue.match(upperCaseLetters)){
        $('.capital-letter').addClass('text-success');
        $('.capital-letter').children('i').addClass('fa-check');
        $('.capital-letter').children('i').addClass('text-success');
        $('.capital-letter').removeClass('text-danger');
        $('.capital-letter').children('i').removeClass('text-danger');
        $('.capital-letter').children('i').removeClass('fa-times');
    }else{
        $('.capital-letter').removeClass('text-success');
        $('.capital-letter').children('i').removeClass('fa-check');
        $('.capital-letter').children('i').removeClass('text-success');
        $('.capital-letter').addClass('text-danger');
        $('.capital-letter').children('i').addClass('text-danger');
        $('.capital-letter').children('i').addClass('fa-times');
    }
    // Validate numbers
    if(passValue.match(numbers)) {
        $('.number-check').addClass('text-success');
        $('.number-check').children('i').addClass('fa-check');
        $('.number-check').children('i').addClass('text-success');
        $('.number-check').removeClass('text-danger');
        $('.number-check').children('i').removeClass('text-danger');
        $('.number-check').children('i').removeClass('fa-times');
    }else{
        $('.number-check').removeClass('text-success');
        $('.number-check').children('i').removeClass('fa-check');
        $('.number-check').children('i').removeClass('text-success');
        $('.number-check').addClass('text-danger');
        $('.number-check').children('i').addClass('text-danger');
        $('.number-check').children('i').addClass('fa-times');
    }

    //special characters
    if(passValue.match(format)) {
        $('.special-characters').addClass('text-success');
        $('.special-characters').children('i').addClass('fa-check');
        $('.special-characters').children('i').addClass('text-success');
        $('.special-characters').removeClass('text-danger');
        $('.special-characters').children('i').removeClass('text-danger');
        $('.special-characters').children('i').removeClass('fa-times');
    }else{
        $('.special-characters').removeClass('text-success');
        $('.special-characters').children('i').removeClass('fa-check');
        $('.special-characters').children('i').removeClass('text-success');
        $('.special-characters').addClass('text-danger');
        $('.special-characters').children('i').addClass('text-danger');
        $('.special-characters').children('i').addClass('fa-times');
    }
    
})
$("#editButtons").click(function(){
    $("#saveButtons").removeClass('d-none');
    $(this).addClass('d-none');
    $(".photo-upload").removeClass('d-none');
    $(".form-control").removeAttr('disabled');
    $(".form-control").addClass('border-dark');
});
$("#cancelButtons").click(function(){
   $("#saveButtons").addClass('d-none');
   $("#editButtons").removeClass('d-none');
   $(".photo-upload").addClass('d-none');
   $(".form-control").attr('disabled', 'disabled');
   $(".form-control").removeClass('border-dark');
});
var resizeOpts = {
    handles: 'e, w',
};
$( "#kt_quick_cart" ).resizable(resizeOpts);
$("#kt_quick_cart").resize(function() {
    $(this).css("left", 'auto');
    $(this).css("overflow-x", 'hidden');
});
// $("#kt_quick_cart_toggle").click(function() {
//     $('html').addClass('side-panel-overlay');
// });
// $("#kt_quick_cart_close").click(function(){
//     $("#kt_quick_cart_close").removeClass('offcanvas-on');
//     $('html').removeClass('side-panel-overlay');
// });
$("#ajaxLoad").click(function(){
    $.get('ajax-load', function(data){
        $("#kt_content").html(data);
    });
    // var url = '{{url('ajax-load')}}';
    // console.log('url', url);
})
// Class definition


/*********************************/
/**********************************/
$('select').select2();
Split(['#split-0', '#split-1', '#split-2'],{
    minSize: 150,
    snapOffset: 10,
    gutterSize: 5,
});
// Split(['#split-3', '#split-4'], {
//     direction: 'vertical',
//     minSize: 150,
//     gutterSize: 5,
//     snapOffset: 10,
// });

