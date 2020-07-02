$(document).ready(function(){
   var cat = $('.update-image'),
    categoryModal = $('#categoryModal'),
    categoryForm = $('#categoryForm'),
    categoryUpdateRoute = $('#categoryForm').attr('action'),
    cagegoryName,
    categoryImage,
    categoryId;

   cat.on('click', function (event) {
       cagegoryName = $(this).data('cat-name'),
       categoryImage = $(this).data('cat-img'),
       categoryId = $(this).data('cat-id');
       categoryModal.find('#categoryModalLongTitle').text(cagegoryName);
       categoryModal.find('.cat-image').attr('src', categoryImage);
       categoryForm.attr('action', categoryUpdateRoute+'/'+categoryId);
   });
})
