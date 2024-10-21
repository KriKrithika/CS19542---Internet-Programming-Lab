function toggleDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.rounded-img')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
