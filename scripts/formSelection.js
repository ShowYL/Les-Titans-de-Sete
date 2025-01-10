const modal = document.getElementById("myModal");
const btn = document.getElementById("addBtn");
const span = document.getElementsByClassName("close")[0];
const form = document.getElementById("dynamicForm");
const formActionInput = document.getElementById("formAction");
const idInput = document.getElementById("id");
const originalFormAction = form.getAttribute('action');

btn.onclick = function() {
  form.setAttribute('action', originalFormAction); // remettre à l'action originale
  formActionInput.value = "add";
  idInput.value = ''; // supprimer l'id de la ligne selectionnée
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
  form.setAttribute('action', originalFormAction); // remettre à l'action originale
  formActionInput.value = "add"; // Reset to add

  // supprimer les valeurs des champs du formulaire
  const inputs = form.querySelectorAll('input, select, textarea');
  for (let i = 0; i < inputs.length; i++) {
    if (inputs[i].type === 'hidden') continue; // Skip hidden inputs
    inputs[i].value = '';
  }
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    form.setAttribute('action', originalFormAction); // remettre à l'action originale
    formActionInput.value = "add"; // Reset to add

    // supprimer les valeurs des champs du formulaire
    const inputs = form.querySelectorAll('input, select, textarea');
    for (let i = 0; i < inputs.length; i++) {
      if (inputs[i].type === 'hidden') continue; // Skip hidden inputs
      inputs[i].value = '';
    }
  }
}
