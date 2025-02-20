const createItem = (value) => {
  const list = document.querySelector('.list');

  const div = list.appendChild(document.createElement('div'));

  div.classList.add('item');

  const mainContainer = div.appendChild(document.createElement('div'));

  mainContainer.classList.add('itemMainContainer');

  const checkbox = mainContainer.appendChild(document.createElement('input'));
  const newItem = mainContainer.appendChild(document.createElement('li'));

  const buttonDelete = div.appendChild(document.createElement('img'));

  buttonDelete.src = '../assets/trash-fill.svg'

  checkbox.type = 'checkbox';
  checkbox.classList.add('check');

  checkbox.onclick = () => {
    if(checkbox.checked) {
      newItem.style.textDecoration = 'line-through';
      return;
    }

    newItem.style.textDecoration = 'none';
  };

  buttonDelete.onclick = () => div.remove();

  newItem.innerText = value;
}

const send = () => {
  const input = document.querySelector('.input');

  if(!input.value)
    return;

  createItem(input.value);

  input.value = '';

}

document.querySelector('.add').addEventListener('click', () => {
  send();
})

document.querySelector('.input').addEventListener('keydown', (e) => {
  if(e.key !== 'Enter')
    return;

  send();
})