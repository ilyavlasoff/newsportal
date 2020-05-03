let loadFile = function(event) {
    let image = document.getElementById('previewImg');
    image.src = URL.createObjectURL(event.target.files[0]);
};

let input = document.getElementById('first_customization_form_userPic');
input.addEventListener('change', loadFile);