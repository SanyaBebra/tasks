'use strict';

const mainWrapper = document.querySelector('.main__wrapper');
const mainInput = document.querySelector('.main__input');

loadTasks();

if (document.querySelector('.header__log-out')) {
  document.querySelector('.header__log-out').addEventListener('click', () => {
    fetch('backend/logOut.php', {
      method: 'POST',
      credentials: 'same-origin'
    })
    .then(res => {
      if (res.ok) {
        window.location.reload();
      }
    });
  });
}

mainInput.addEventListener('submit', function (event) {
  event.preventDefault();
  
  const formData = new FormData(this);
  const jsonData = JSON.stringify(Object.fromEntries(formData.entries()));

  document.querySelector('.main__input > input').value = '';

  fetch('backend/addTask.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: jsonData
  })
  .then(res => res.text())
  .then(data => {
    const divError = document.querySelector('.input__error');
    divError.style.color = 'red';
    divError.innerHTML = data;
    loadTasks();
  })
  .catch(err => console.log(err));
});

mainWrapper.addEventListener('change', (event) => {
  if (event.target.type === 'checkbox') {
    event.target.nextElementSibling.style.textDecoration = event.target.checked ? "line-through" : "none";
    event.target.nextElementSibling.style.color = event.target.checked ? 'gray' : 'black';
  }
});

mainWrapper.addEventListener('click', (event) => {
  if (event.target.classList.contains('delete-btn')) {
    const id = Number(event.target.dataset.taskId);
    
    fetch('backend/deleteTask.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        taskId: id
      })
    })
    .then(res => res.json())
    .then(data => loadTasks())
    .catch(err => console.log('ERROR delete: ' + err));
  }
});

function loadTasks() {
  fetch('backend/loadTasks.php')
  .then(res => res.json())
  .then(data => {
    mainWrapper.innerHTML = '';
    data.forEach(task => {
      mainWrapper.appendChild(createTaskBlock(task['task_text'], task['id']));
    });
  })
  .catch(err => console.log('ERROR load: ' + err));
}

function createTaskBlock(taskText, taskId) {
  const taskDiv = document.createElement('div');
  taskDiv.classList.add('task');

  const checkbox = document.createElement('input');
  checkbox.type = 'checkbox';
  checkbox.name = 'checkbox';

  const taskTextElement = document.createElement('p');
  taskTextElement.textContent = taskText;

  const deleteBtn = document.createElement('img');
  deleteBtn.src = 'images/delete.png';
  deleteBtn.alt = 'delete';
  deleteBtn.classList.add('delete-btn');
  deleteBtn.dataset.taskId = taskId;

  // Добавляем элементы в блок задачи
  taskDiv.appendChild(checkbox);
  taskDiv.appendChild(taskTextElement);
  taskDiv.appendChild(deleteBtn);

  return taskDiv;
}