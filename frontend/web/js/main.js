$(document).ready(function () {

    var select_cat =$('#imageuploadform-category_id');
    var btn_add_cat = $('#addCategory');
    var content;
    var new_option = {};
    var newCategory = $("<option>");
    var input = $('#inputCat');

    //Add option Add Category
    var optionAddCat = $("<option>").text('Добавить категорию').val(-1);
    select_cat.append(optionAddCat);

    //When you select this option, you show modal window
    select_cat.change(function () {
       console.log(select_cat.val());
        if (select_cat.val() == -1)
        {
            $('#myModal').modal('show');
            $('#inputCat').focus();
        }
    });

    btn_add_cat.click(function () {
        content = input.val();
        new_option = {
            content: content
        };
        console.log(new_option);
        $.ajax({
            url: "/category/add",
            type: "POST",
            data: "category=" + JSON.stringify(new_option),
            success: function (data) {
                optionAddCat.before(
                    newCategory.text(content).val(data)
                );
                select_cat.val(data);
                $('#myModal').modal('hide');
            },
            error: function (data) {
                input.after(
                    $('<p>', {class: 'bg-danger', text: data.responseText})
                );
            }
        });
    })
});
