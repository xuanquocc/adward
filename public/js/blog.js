var actionElm = document.getElementById('action');
var menusElm = document.getElementById('menus');
var editBtn = document.getElementById('edit-blog');

actionElm.addEventListener('click',function () {
    menusElm.classList.toggle('show');
})

editBtn.addEventListener('click', function() {
    menusElm.classList.toggle('show')
})

