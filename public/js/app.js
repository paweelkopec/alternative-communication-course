/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $(this).closest('.form-horizontal'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
		$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
    });
    
    $(".edit-curse").click(function(e){
         e.preventDefault();
         $(".main-loader").show();
         var id =$(this).attr('data-target');
         $("#form-edit").attr('action', "/course/"+id);
         $.ajax({
              type: "GET",
              url: "course/"+id,
         }).done(function(data) {
               $("#modal-course-edit").modal();
               $("#modal-course-edit").find('.modal-body').html(data)
               $(".main-loader").hide();
         });
    });
    
});