var actionElms = document.querySelectorAll('.action');
var menusElms = document.querySelectorAll('.menus');
var editBtns = document.querySelectorAll('.edit-blog');

actionElms.forEach(function (actionElm, index) {
    actionElm.addEventListener('click', function () {
        menusElms[index].classList.toggle('show');
    });
});

editBtns.forEach(function (editBtn) {
    editBtn.addEventListener('click', function () {
        // Assuming the corresponding menu is next to the edit button
        var menusElm = editBtn.parentElement.nextElementSibling;
        
        if (menusElm) {
            menusElm.classList.toggle('show');
        }
    });
});
    