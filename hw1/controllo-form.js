
function controllo(event){
    if(form.nome.value.length == 0 || form.cognome.value.length == 0 ||
        form.email.value.length == 0 ||form.username.value.length == 0 ||
        form.password.value.length == 0 ||form.confpassword.value.length == 0){
            alert.classList.remove('hidden');
            alert.innerHTML = "Per favore, completa tutti i campi.";
            event.preventDefault();
            if(form.nome.value.length == 0){
                form.nome.classList.add('incorrect');
            }else{
                form.nome.classList.remove('incorrect');
            }
            if(form.cognome.value.length == 0){
                form.cognome.classList.add('incorrect');
            }else{
                form.cognome.classList.remove('incorrect');
            }
            if(form.email.value.length == 0){
                form.email.classList.add('incorrect');
            }else{
                form.email.classList.remove('incorrect');
            }
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
            if(form.confpassword.value.length == 0){
                form.confpassword.classList.add('incorrect');
            }else{
                form.confpassword.classList.remove('incorrect');
            }
    }else if( !formato_email.test(form.email.value)){
        event.preventDefault();
        form.email.classList.add('incorrect');
        alert.classList.remove('hidden');
        alert.innerHTML = "Il campo e-mail non è corretto.";
        form.email.focus();
    }else if(form.password.value != form.confpassword.value){
        event.preventDefault();
        //Rimozione alert precedenti
        form.email.classList.remove('incorrect');
        alert.classList.add('hidden');

        form.confpassword.classList.add('incorrect');
        alert.classList.remove('hidden');
        alert.innerHTML = "Le password non corrispondono.";
    }else if(globUserExist){
        event.preventDefault(); 
        //Rimozione alert precedenti
        form.email.classList.remove('incorrect');
        form.confpassword.classList.remove('incorrect');
        form.password.classList.remove('incorrect');
        alert.classList.add('hidden');

        form.username.classList.add('incorrect');
        alert.classList.remove('hidden');
        alert.innerHTML = "L'username specificato esiste già.";
    }else{
         //Rimozione alert precedenti
         form.email.classList.remove('incorrect');
         form.confpassword.classList.remove('incorrect');
         form.password.classList.remove('incorrect');
         form.username.classList.remove('incorrect');
         alert.classList.add('hidden');
    }
}
function onText(text){
    if (text == true){
        globUserExist = true;
        form.username.classList.remove('correct')
        form.username.classList.add('incorrect');
       
        imgUser.src = "croce.jpg";
        
        imgCont.classList.remove('hidden');
    } else{
        globUserExist = false;
        form.username.classList.remove('incorrect');
        form.username.classList.add('correct');
        
        imgUser.src = "spunta.jpg";
        
        imgCont.classList.remove('hidden');
    }
}
function onResponse(response){
    return response.text();
}
function controlloUsername(event){
    const inp_name = event.currentTarget;
    let formData = new FormData();
    formData.append('contr_user', inp_name.value);
    fetch("http://localhost/hw1/signup.php",{method:'POST', body: formData}).then(onResponse).then(onText);
}
const formato_email = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;
let globUserExist = false;

const form = document.forms['signup'];

const user = form.querySelector("#user");

const imgUser = document.createElement('img');
const imgCont = document.querySelector("#user-exist-cont");
imgCont.appendChild(imgUser);

user.addEventListener('blur',controlloUsername);
const alert = document.querySelector('#alert');

form.addEventListener('submit',controllo);
