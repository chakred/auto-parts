$(document).ready(function () {

    const warnDeleteModel = () => {
        $('.delete-model').on('click', function(){
            let model_id = $(this).attr('data-model-id');
            let confirmThis = confirm("Вы действительно хотите удалить модель ID" + model_id + "?");
            if(!confirmThis){
                return false;
            }
        })
    }

    const warnDeleteCategory = () => {
        $('.delete-category').on('click', function(){
            let category_id = $(this).attr('data-category-id');
            let confirmThis = confirm("Вы действительно хотите удалить категорию ID" + category_id + "?");
            if(!confirmThis){
                return false;
            }
        })
    }

    const warnDeleteGood = () => {
        $('.delete-good').on('click', function(){
            let good_id = $(this).attr('data-good-id');
            let confirmThis = confirm("Вы действительно хотите удалить товар ID" + good_id + "?");
            if(!confirmThis){
                return false;
            }
        })
    }

    const init = () => {
        warnDeleteModel();
        warnDeleteCategory();
        warnDeleteGood();
    }
    init();
})
