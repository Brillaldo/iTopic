
// Datos de ejemplo para la lista de ranking
const rankingData = [
    { username: 'Usuario1', points: 120 },
    { username: 'Usuario2', points: 115 },
    { username: 'Usuario3', points: 110 },
    { username: 'Usuario4', points: 100 },
    { username: 'Usuario5', points: 95 }
];

// Generar lista de ranking
const rankedList = document.getElementById('ranked-list');

rankingData.forEach(user => {
    const listItem = document.createElement('li');
    listItem.textContent = `${user.username} - ${user.points} puntos`;
    rankedList.appendChild(listItem);
});


let currentStoryIndex = 0;
const stories = document.querySelectorAll('.story');
const thumbnails = document.querySelectorAll('.thumbnail');
const totalStories = stories.length;
const intervalDuration = 5000; // Duración de cada historia (5 segundos)
let storyInterval;
const storiesSlider = document.getElementById('storiesSlider');
const sliderControls = document.getElementById('sliderControls');
const thumbnailsContainer = document.getElementById('thumbnailsContainer');
const closeBtn = document.getElementById('closeBtn');

// Mostrar la historia actual con deslizamiento horizontal
function showStory(index) {
    storiesSlider.style.transform = `translateX(-${index * 100}%)`;
}

// Ir a la siguiente historia
function nextStory() {
    currentStoryIndex = (currentStoryIndex + 1) % totalStories;
    showStory(currentStoryIndex);
    resetInterval();
}

// Ir a la historia anterior
function prevStory() {
    currentStoryIndex = (currentStoryIndex - 1 + totalStories) % totalStories;
    showStory(currentStoryIndex);
    resetInterval();
}

// Reiniciar el intervalo para el deslizamiento automático
function resetInterval() {
    clearInterval(storyInterval);
    storyInterval = setInterval(nextStory, intervalDuration);
}

// Inicializar el slider
function initSlider() {
    showStory(currentStoryIndex);
    storyInterval = setInterval(nextStory, intervalDuration);
}

// Mostrar el slider y ocultar las miniaturas al hacer clic en una miniatura
thumbnails.forEach((thumbnail) => {
    thumbnail.addEventListener('click', (e) => {
        currentStoryIndex = parseInt(thumbnail.getAttribute('data-index'));
        thumbnailsContainer.style.display = 'none'; // Ocultar miniaturas
        storiesSlider.style.display = 'flex';
        sliderControls.style.display = 'flex';
        showStory(currentStoryIndex);
        resetInterval();
    });
});

// Cerrar el slider y regresar a las miniaturas
closeBtn.addEventListener('click', () => {
    storiesSlider.style.display = 'none';
    sliderControls.style.display = 'none';
    thumbnailsContainer.style.display = 'flex';
    clearInterval(storyInterval);
});

// Listeners para los botones de control
document.getElementById('next-btn').addEventListener('click', nextStory);
document.getElementById('prev-btn').addEventListener('click', prevStory);

// Inicializar el slider al cargar la página
window.onload = () => {
    storiesSlider.style.display = 'none';
    sliderControls.style.display = 'none';
};
