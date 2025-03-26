document.getElementById("cadastroForm").addEventListener("submit", function(event){
    event.preventDefault();
    let formData = new FormData(this);

    fetch("Cadastro.php", {
        method: "POST",
        body: formData // Corrigido 'BODY' para 'body'
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message || data.error);
        if (data.success){
            window.location.href = "index.html";
        }
    })
    .catch(error => console.error("Erro:", error));
});
