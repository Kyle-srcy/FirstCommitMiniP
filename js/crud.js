const createBtn = document.getElementById('createBtn');
const userTable = document.getElementById('userTable');
let userId = 1;

createBtn.addEventListener('click', () => {
  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const username = document.getElementById('username').value;

  if(name && email && username){
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${userId++}</td>
      <td>${name}</td>
      <td>${email}</td>
      <td>${username}</td>
      <td>
        <button class='btn btn-update'>Edit</button>
        <button class='btn btn-delete'>Delete</button>
      </td>
    `;
    userTable.appendChild(row);

    // Clear inputs after adding
    document.getElementById('name').value = '';
    document.getElementById('email').value = '';
    document.getElementById('username').value = '';
    document.getElementById('password').value = '';

    // Add edit and delete functionality
    const editBtn = row.querySelector('.btn-update');
    const deleteBtn = row.querySelector('.btn-delete');

    editBtn.addEventListener('click', () => {
      document.getElementById('name').value = row.cells[1].innerText;
      document.getElementById('email').value = row.cells[2].innerText;
      document.getElementById('username').value = row.cells[3].innerText;

      userTable.removeChild(row);
      userId--;
    });

    deleteBtn.addEventListener('click', () => {
      userTable.removeChild(row);
      userId--;
    });
  }
});
