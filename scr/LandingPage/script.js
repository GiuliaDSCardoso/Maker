/*document.addEventListener("DOMContentLoaded", carregarComentarios);
        
function carregarComentarios() {
    fetch("carregar_comentarios.php")
        .then(response => response.json())
        .then(data => {
            let container = document.getElementById("comentarios-container");
            container.innerHTML = "";
            data.forEach(comentario => {
                let novoComentario = document.createElement("div");
                novoComentario.classList.add("comentario");
                novoComentario.textContent = comentario.texto;
                container.appendChild(novoComentario);
            });
        });
}

function adicionarComentario() {
    let input = document.getElementById("sugestao");
    let texto = input.value.trim();
    
    if (texto !== "") {
        fetch("salvar_comentario.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "texto=" + encodeURIComponent(texto)
        })
        .then(response => response.text())
        .then(() => {
            input.value = "";
            carregarComentarios();
        });
    }
}*/