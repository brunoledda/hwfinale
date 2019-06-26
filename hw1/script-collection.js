function rimuovi(event){
    event.stopPropagation();
    const bottone = event.currentTarget;
    let formData = new FormData();
    formData.append("id_spotify",bottone.childNodes[1].innerHTML)
    formData.append("id_raccolta", id_container.innerHTML);
    fetch("http://localhost/hw1/elimina.php",{method: "POST", body: formData}).then(function(){document.location.reload(true);});
}
function onModalClick(){
    document.body.classList.remove('no-scroll');
    modalView.classList.add('hidden');
    modalView.innerHTML ='';
}
function onClick(event){
    const evento = event.currentTarget;
    const image =document.createElement('img');
    image.src=evento.childNodes[0].src;
    const title = document.createElement('p');
    title.innerHTML= evento.childNodes[1].innerHTML;
    const id = document.createElement('p');
    id.innerHTML =evento.childNodes[2].innerHTML;
    document.body.classList.add('no-scroll');
    modalView.style.top = window.pageYOffset +'px';
    modalView.appendChild(image);
    modalView.appendChild(title);
    modalView.appendChild(id);
    modalView.classList.remove('hidden');

}
function onJson(json){
    console.log(json);
    for(const j of json){
        const div = document.createElement('div');
        div.classList.add('collection');
        content.appendChild(div);

        const img = document.createElement('img');
        img.src = j.img_url;
        div.appendChild(img);

        const p= document.createElement('p');
        p.innerHTML= j.titolo;
        div.appendChild(p);

        const p1 = document.createElement('p');
        p1.innerHTML =j.id_risorsa;
        p1.classList.add("hidden");
        div.appendChild(p1);

        const p2 = document.createElement('p');
        p2.innerHTML =j.id_risorsa;
        p2.classList.add("hidden");
        div.appendChild(p2);


        const button = document.createElement('button');
        button.type = 'button';
        button.name = 'remove';
        button.classList.add('button');
        button.innerHTML = "Rimuovi";
        button.appendChild(p2); //p2 = id_spotify
        button.addEventListener("click", rimuovi);
        div.appendChild(button);
        
        div.addEventListener("click",onClick);

    }

}
function onJsonResponse(response){
    return response.json();
}
const modalView = document.querySelector('#modal-view');
modalView.addEventListener('click',onModalClick);
const content =document.querySelector("#content");
const id_container = document.querySelector("#id_racc");
fetch("http://localhost/hw1/richiesta.php?id_raccolta="+ id_container.innerHTML).then(onJsonResponse).then(onJson);
