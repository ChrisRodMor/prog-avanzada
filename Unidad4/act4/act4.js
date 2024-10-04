document.addEventListener("DOMContentLoaded", function() {
    const colors = ['#0275D8', '#5DB85B', '#5CC0DE', '#F0AD4E', '#D6524E'];
    const listItems = document.querySelectorAll('#roleList li');

    listItems.forEach((item, index) => {
        item.style.backgroundColor = colors[index];
    });
});