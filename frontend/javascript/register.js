const form = document.querySelector('form');

document.addEventListener('submit', (e) => {
  e.preventDefault();

  const formData = new FormData(form);

  fetch('http://localhost:81/register', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => console.log(data))
  .catch(err => console.error(err))
})