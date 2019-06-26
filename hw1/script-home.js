
function visualizza(event){
    const pl = event.currentTarget;
    const id_racc = pl.childNodes[2].innerHTML;
    location.href = "collection.php?id_raccolta=" + id_racc;
}

function addPlaylist(){
    event.preventDefault();
    const form = document.forms['nome'];
    let formData = new FormData();
    formData.append('playlistTitle', form.title.value);
    fetch("http://localhost/hw1/home.php",{method:'POST', body: formData});
    if(form.title.value.length >0){
        document.location.reload(true);
    }
}
function onClick(){
    add.removeEventListener("click",onClick);
    add.addEventListener("click",function onClick1(){
        const inp = document.querySelector("#titolo-playlist");
        inp.focus();
    });
    const playlist = document.createElement('div');
    playlist.classList.add('box');
    grid.appendChild(playlist);

    const img = document.createElement('img');
    img.src= "empty.png";
    img.classList.add("item");
    playlist.appendChild(img);

    const form = document.createElement('form');
    form.name="nome";
    form.method='post';
    //form.classList.add('item');
    const input = document.createElement('input');
    input.type = "text";
    input.name = "title";
    input.id= "titolo-playlist";
    input.classList.add('item');
    form.appendChild(input);
    playlist.appendChild(form);

    input.addEventListener("blur",addPlaylist);
    form.addEventListener("submit",addPlaylist);
}
const grid = document.querySelector("#grid");
const add = document.querySelector("#playlist-create");
add.addEventListener("click",onClick);

const raccolte = document.querySelectorAll('#playlist');
for(const racc of raccolte){
    racc.addEventListener("click",visualizza);
}