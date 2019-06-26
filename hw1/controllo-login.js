function controllo(event){
    if(form.username.value.length == 0 || form.password.value.length == 0){
        alert.classList.remove('hidden');
        alert.innerHTML = "Per favore, inerisci tutti i campi.";
        event.preventDefault();
        if(form.username.value.length == 0){
            form.username.classList.add('incorrect');
        }else{
            form.username.classList.remove('incorrect');
        }
        if(form.password.value.length == 0){
            form.password.classList.add('incorrect');
        }else{
            form.password.classList.remove('incorrect');
        }
    } 
}
const form = document.forms['login'];
const alert = document.querySelector('#alert');
form.addEventListener('submit',controllo);