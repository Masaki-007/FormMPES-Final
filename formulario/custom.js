const form = document.getElementById("formulario");

if (form) {
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const dadosForm = new FormData(form);

    const alertForm = await fetch("cadastrar.php", {
      method: "POST",
      body: dadosForm
    });

    const resposta = await alertForm.json();


    if (resposta['status']) {
      Swal.fire({
        text: resposta['msg'],
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Fechar'
      });

    } else {
      Swal.fire({
        text: resposta['msg'],
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Fechar'
      });
    }
  });
}