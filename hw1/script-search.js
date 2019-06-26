function prevent(event){
    event.preventDefault();
    event.stopPropagation();
}
function clickDiv(event){
    const div = event.currentTarget;
    if(div!= event.target){   
        const img_url = div.childNodes[0].src;
        const tit = div.childNodes[1].innerHTML;
        const id_risorsa = div.childNodes[2].innerHTML;
        const id_racc = div.childNodes[3].childNodes[0].value;
        let formData2 = new FormData();
        formData2.append('img_url', img_url);
        formData2.append('titolo', tit);
        formData2.append('id_risorsa', id_risorsa);
        formData2.append('id_raccolta', id_racc);
        fetch("http://localhost/hw1/search.php",{method:'POST', body: formData2});
    }
}
function onJson(json){ 
        result.innerHTML=""; //restore delle eventuali ricerche precedenti
        for(it of json.tracks.items){
            const elemento = document.createElement('div');
            result.appendChild(elemento);
            const image = document.createElement('img');
            image.src = it.album.images["0"].url;
            const title = document.createElement('p');
            title.innerHTML = it.name;
            const id = document.createElement('p');
            id.innerHTML = it.id;
            id.classList.add('hidden');

            elemento.appendChild(image);
            elemento.appendChild(title);
            elemento.appendChild(id);

            id.addEventListener("click",prevent);
            image.addEventListener("click",prevent);
            title.addEventListener("click",prevent);

            const form1 = document.createElement('form');
            form1.name="select";
            form1.method='post';
            elemento.appendChild(form1);
            const scelta = document.createElement('select');
            scelta.name="scelta";
            scelta.classList.add("scelta");
            form1.appendChild(scelta);

            form1.addEventListener("click",prevent);

            const button = document.createElement('button');
            button.type = 'button';
            button.name = 'add';
            button.classList.add('button');
            button.innerHTML = "Aggiungi alla raccolta";
            elemento.appendChild(button);

            elemento.addEventListener("click",clickDiv);

        }
        let formData1 = new FormData();
        formData1.append('richiesta', true);
        fetch("http://localhost/hw1/search.php",{method:'POST', body: formData1}).then(onJsonResponse1).then(onJson1);
        function onJsonResponse1(response1){
            return response1.json();
        }
        const selezione = document.querySelectorAll('select');
        function onJson1(json1){
            for (sel of selezione){
                for(play of json1){
                    let opzione = document.createElement('option');
                    opzione.value = play.id_raccolta;
                    opzione.innerHTML= play.titolo;
                    sel.appendChild(opzione); 
                }
            }
        }  
}
function onJsonResponse(response){
    return response.json();
}
function doSearch(event){
    let formData = new FormData();
    formData.append('textToSearch', form.text.value);
    event.preventDefault();
    fetch("http://localhost/hw1/do_search.php",{method:'POST', body: formData}).then(onJsonResponse).then(onJson);
}
const result = document.querySelector('#result');
const form = document.forms['search'];
form.addEventListener('submit', doSearch);