function validateRequestForm(){

let phone = document.forms["requestForm"]["contact_number"].value;
let members = document.forms["requestForm"]["family_members"].value;

if(phone.length < 10){
alert("Contact number must be at least 10 digits");
return false;
}

if(members <= 0){
alert("Family members must be greater than 0");
return false;
}

return true;
}

function toggleDropdown() {
    const dropdown = document.getElementById('dropdown');
    const arrow = document.querySelector('.arrow');

    if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
        arrow.textContent = '▼';
    } else {
        dropdown.style.display = 'block';
        arrow.textContent = '▲';
    }
}

// Update header text when checkboxes change
document.querySelectorAll('.multi-select-dropdown input[type="checkbox"]').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        const checked = document.querySelectorAll('.multi-select-dropdown input[type="checkbox"]:checked');
        const selectedText = document.getElementById('selected-text');

        if (checked.length === 0) {
            selectedText.textContent = '--Select Relief Types--';
        } else {
            selectedText.textContent = Array.from(checked).map(c => c.value).join(', ');
        }
    });
});

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    const multiSelect = document.querySelector('.multi-select');
    if (!multiSelect.contains(e.target)) {
        document.getElementById('dropdown').style.display = 'none';
        document.querySelector('.arrow').textContent = '▼';
    }
});