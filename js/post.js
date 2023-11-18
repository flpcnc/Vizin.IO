var map = L.map('map');
var newPostMarker = L.marker();
var form = document.getElementById('novo-post');

var orangeIcon = L.icon({
    iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-orange.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

var grayIcon = L.icon({
    iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

const content = document.querySelector('#content');
const sidebar = document.querySelector('#sidebar');

//@TODO Pegar endereco do cadastro do usuario
var url = 'https://nominatim.openstreetmap.org/search?q=Jose+Patrocinio,Cidade+Baixa+,Porto+Alegre,Brazil&format=json&limit=1';

fetch(url)
    .then(response => response.json())
    .then(data => {
        var lat = data[0].lat;
        var lon = data[0].lon;

        map.setView([lat, lon], 17);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
    });

function onMapClick(e) {
    getReverseOnSidebar(e.latlng.lat, e.latlng.lng, true);
}

function getReverseOnSidebar(lat, lng, isMapClick) {
    showLoader();

    closeSidebar();

    if (isMapClick) {
        newPostMarker = L.marker([lat, lng]).setIcon(grayIcon).addTo(map)
            .bindPopup('Local do seu post').openPopup();
    }

    document.querySelector('#latitude').value = lat;
    document.querySelector('#longitude').value = lng;

    console.log('clique do mapa');
    console.log(lat);
    console.log(lng);

    var url = 'https://nominatim.openstreetmap.org/reverse?format=jsonv2&accept-language=pt&lat=' + lat + '&lon=' + lng;
    fetch(url)
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            var nome = data.address.amenity;
            var rua = data.address.road;
            var numero = data.address.house_number;

            document.querySelector('#place').innerHTML = data.address.suburb + ', ' + data.address.city

            if (nome) {
                document.querySelector('#local').value = nome;
            }

            if (rua) {
                document.querySelector('#endereco').value = rua + (numero ? ', ' + numero : '');
            }

            openSidebar();

            map.panTo([lat, lng]);

            hideLoader();
        });
}


map.on('click', onMapClick);

function closeSidebar() {
    content.classList.remove('is-shifted');
    sidebar.classList.remove('is-shifted');

    if (newPostMarker) {
        newPostMarker.remove();
    }

    document.querySelector('#div-novo').style.display = 'block';
    clearForm();
}

function openSidebar() {
    content.classList.add('is-shifted');
    sidebar.classList.add('is-shifted');
}

document.getElementById('close-sidebar').addEventListener('click', () => {
    closeSidebar();
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeSidebar();
    }
});

function clearForm() {
    const form = document.querySelector('form');

    const camposDeEntrada = form.querySelectorAll('input, textarea');

    camposDeEntrada.forEach(campo => {
        campo.value = '';
    });
}

form.onsubmit = async (e) => {
    showLoader();

    e.preventDefault();

    let latitude = document.querySelector('#latitude').value;
    let longitude = document.querySelector('#longitude').value;
    console.log('submit');
    console.log(latitude);
    console.log(longitude);

    let response = await fetch(form.getAttribute('action'), {
        method: 'POST',
        body: new FormData(form)
    });

    let result = await response;

    if (newPostMarker) {
        if (newPostMarker.getPopup()) {
            newPostMarker.getPopup().remove();
        }

        popup = newPostMarker.setIcon(orangeIcon).bindPopup(L.popup())
            .on('click', function (e) { fetchPositionPosts(this, latitude, longitude) });

        newPostMarker = L.marker();
    }

    closeSidebar();
    hideLoader();
};

//@TODO Separar o js e o css do loader
function showLoader() {
    document.getElementById('loader').style.display = 'flex';
}

function hideLoader() {
    document.getElementById('loader').style.display = 'none';
}

async function fetchPins() {
    response = await fetch("/post/pins");
    pins = await response.json();
    for (const pin of pins) {
        L.marker([pin.latitude, pin.longitude])
            .setIcon(orangeIcon)
            .bindPopup(L.popup())
            .on('click', function (e) { fetchPositionPosts(this, e.latlng.lat, e.latlng.lng) })
            .addTo(map);
    }
}

fetchPins();

async function fetchPositionPosts(marker, latitude, longitude) {
    showLoader();

    let posts;
    response = await fetch(`/post/posts?latitude=${latitude}&longitude=${longitude}`);
    posts = await response.json();

    const markerContent = document.createElement('div');
    markerContent.classList.add('marker-popup');

    const newPostDiv = document.createElement('div');
    newPostDiv.classList.add('group-new-post');
    newPostDiv.onclick = () => {
        getReverseOnSidebar(latitude, longitude, false);
        marker.getPopup().close();
    };

    const newPostIcon = document.createElement('i');
    newPostIcon.classList.add('material-icons');
    newPostIcon.textContent = 'add_circle';
    newPostDiv.appendChild(newPostIcon);

    const newPostSpan = document.createElement('span');
    newPostSpan.textContent = 'Novo post';
    newPostDiv.appendChild(newPostSpan);

    markerContent.appendChild(newPostDiv);

    const markerHeader = document.createElement('div');
    markerHeader.classList.add('marker-header');

    const markerHeaderTitle = document.createElement('h3');
    markerHeaderTitle.textContent = 'Posts';

    markerHeader.appendChild(markerHeaderTitle);
    markerContent.appendChild(markerHeader);

    const markerPostsList = document.createElement('ul');
    markerPostsList.classList.add('marker-posts');

    for (const post of posts) {
        const markerPost = document.createElement('li');
        markerPost.classList.add('marker-post');

        const postTitle = document.createElement('h4');
        postTitle.textContent = post.assunto;

        const postContent = document.createElement('p');
        postContent.innerHTML = `<strong>Local:</strong> ${post.nm_local}<br>
                            <strong>Endereço:</strong> ${post.endereco}<br>
                            <strong>Mensagem:</strong> ${post.descricao}<br>
                            <strong>Data:</strong> ${post.dt_criacao}<br>
                            <strong>Criador:</strong> ${post.nome}`;

        markerPost.appendChild(postTitle);
        markerPost.appendChild(postContent);
        markerPostsList.appendChild(markerPost);
    }

    markerContent.appendChild(markerPostsList);

    marker.getPopup().setContent(markerContent);

    hideLoader();
}