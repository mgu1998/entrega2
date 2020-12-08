(function () {

    let createEnterpriseForm = document.getElementById('createEnterpriseForm');
    if(createEnterpriseForm) {
        createEnterpriseForm.addEventListener('submit', function(event) {
            if(1 == 1) {
                //submit
            } else {
                alert('Fallo al validar en Javascript');
                event.preventDefault();
            }
        })
    }
    
    //colección de elementos cuya clase es enlaceBorrar
    let enlacesBorrar = document.getElementsByClassName('enlaceBorrar');

    for(var i = 0; i < enlacesBorrar.length; i++) {
        enlacesBorrar[i].addEventListener('click', getClassConfirmation);
    }
    
    function getClassConfirmation(event) {
        let id = event.target.dataset.id; //data-id
        let table = event.target.dataset.table; //data-table
        let retVal = confirm('Sure to delete the ' + table + ' number #' + id + '?');
        if(retVal) {
            var formDelete = document.getElementById('formDelete');
            formDelete.action += '/' + id;
            formDelete.submit();
        }
    }
    
    let enlaceBorrar = document.getElementById('enlaceBorrar');
    if(enlaceBorrar) {
        enlaceBorrar.addEventListener('click', getConfirmation);
    }
    function getConfirmation() {
        let id = event.target.dataset.id; //data-id
        let name = event.target.dataset.name; //data-name
        let table = event.target.dataset.table; //data-table
        let retVal = confirm('Sure to delete the ' + table + ' ' + name + ' with id ' + id+ '?');
        if(retVal) {
            var formDelete = document.getElementById('formDelete');
            formDelete.submit();
        }
    }

})();