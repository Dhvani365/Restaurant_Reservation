function toggleDropdown(tableId) {
    const dropdown = document.getElementById('person-dropdown');
    const selectedTable = document.getElementById('selected-table');
    const tableButton = document.getElementById(tableId);
    // Check if the button has the 'disabled' class
    if (tableButton.classList.contains('disable')) {
        alert('This table is already reserved and cannot be selected.');
        dropdown.innerHTML = "The table is already Reserved or Underprocessing, You can't reserve that!";
        dropdown.style.display = 'block';
        return;  // Exit the function without proceeding further
    }

    // Update the displayed table name
    document.getElementById('selected-table').innerText = tableId;
    
    // Update the hidden input with the selected table ID
    document.getElementById('selected-table-input').value = tableId;
    
    // Set the selected table in the dropdown label
    selectedTable.textContent = tableId;

    // Toggle visibility of the dropdown
    if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
    } else {
        dropdown.style.display = 'block';
    }
}
function editRow(id) {
    // Get the current values from the row
    const tableNo = document.getElementById(`table_no-${id}`).innerText;
    const date = document.getElementById(`date-${id}`).innerText;
    const time = document.getElementById(`time-${id}`).innerText;
    const partySize = document.getElementById(`party_size-${id}`).innerText;

    // Replace the table cell content with input fields for editing
    document.getElementById(`table_no-${id}`).innerHTML = `<input type='text' value='${tableNo}' id='edit_table_no-${id}'>`;
    document.getElementById(`date-${id}`).innerHTML = `<input type='date' value='${date}' id='edit_date-${id}'>`;
    document.getElementById(`time-${id}`).innerHTML = `<input type='time' value='${time}' id='edit_time-${id}'>`;
    document.getElementById(`party_size-${id}`).innerHTML = `<input type='number' value='${partySize}' id='edit_party_size-${id}'>`;

    // Change the "Update" button to a "Save" button
    document.querySelector(`#row-${id} td:last-child`).innerHTML = `<button onclick="saveRow(${id})">Save</button>`;
}

function saveRow(id) {
    // Fetch updated values from the input fields
    const updatedTableNo = document.getElementById(`edit_table_no-${id}`).value;
    const updatedDate = document.getElementById(`edit_date-${id}`).value;
    const updatedTime = document.getElementById(`edit_time-${id}`).value;
    const updatedPartySize = document.getElementById(`edit_party_size-${id}`).value;

    // Send the updated values to the server for updating the database
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "ReserveTable.php?action=update&id=" + id, true);  // Send id as parameter
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            // Revert input fields back to plain text
            document.getElementById(`table_no-${id}`).innerText = updatedTableNo;
            document.getElementById(`date-${id}`).innerText = updatedDate;
            document.getElementById(`time-${id}`).innerText = updatedTime;
            document.getElementById(`party_size-${id}`).innerText = updatedPartySize;

            // Change the "Save" button back to "Update"
            document.querySelector(`#row-${id} td:last-child`).innerHTML = `<button onclick="editRow(${id})">Update</button><button onclick="deleteReservation(${id})">Cancel</button>`;
        }
    };

    // Send data
    xhr.send(`table_no=${updatedTableNo}&date_reserve=${updatedDate}&time_reserve=${updatedTime}&partysize=${updatedPartySize}`);
}

function deleteReservation(id) {
    if (confirm('Are you sure you want to cancel this reservation?')) {
        window.location.href = 'ReserveTable.php?action=delete&id=' + id;  // Pass the id
    }
}

