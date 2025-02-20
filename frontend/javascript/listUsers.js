document.addEventListener('DOMContentLoaded', () => {
  fetch('http://localhost:81/getAll', {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {

    data.forEach(element => {
      document.querySelector('.list').appendChild(document.createElement('p')).innerText = `Email do Usuário: ${element.email}`;
    });
  })
  .catch(err => console.error(err))
})