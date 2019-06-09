$(document).ready(function(){
   var subCat = $('.update-image'),
    subCategoryModal = $('#subCategoryModal'),
    subCategoryForm = $('#subCategoryForm'),
    subCategoryUpdateRoute = $('#subCategoryForm').attr('action'),
    subCagegoryName,
    subCategoryImage,
    subCategoryId;

   subCat.on('click', function (event) {
       subCagegoryName = $(this).data('sub-cat-name'),
       subCategoryImage = $(this).data('sub-cat-img'),
       subCategoryId = $(this).data('sub-cat-id');
       subCategoryModal.find('#subCategoryModalLongTitle').text(subCagegoryName);
       subCategoryModal.find('.sub-cat-image').attr('src', subCategoryImage);
       subCategoryForm.attr('action', subCategoryUpdateRoute+'/'+subCategoryId);
   });
})
