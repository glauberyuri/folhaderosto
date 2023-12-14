function showLoading() {
    const existingLoadingDiv = document.getElementById("loading-container");

    // Se não tiver a div carregando criar
    if (!existingLoadingDiv) {
        const loadingDiv = document.createElement("div");
        loadingDiv.id = "loading-container";
        loadingDiv.innerHTML = `
            <div class="centered loading">
                 <div class="loading">
                    <div></div>
                </div>
                <p>Aguarde... Estamos importando os dados</p>
            </div>
        `;
        document.body.appendChild(loadingDiv);
    }
}

function hideLoading() {
    const loadingDiv = document.getElementById("loading-container");

    // If the loading div exists, remove it
    if (loadingDiv) {
        document.body.removeChild(loadingDiv);
    }
}

