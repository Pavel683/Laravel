// let isDown = false;
// let startX;
// let scrollLeft;
//
// document.querySelector('.gallery').addEventListener('mousedown', (e) => {
//     isDown = true;
//     startX = e.pageX - document.querySelector('.gallery').offsetLeft;
//     scrollLeft = document.querySelector('.gallery').scrollLeft;
// });
// document.querySelector('.gallery').addEventListener('mouseleave', () => {
//     isDown = false;
// });
// document.querySelector('.gallery').addEventListener('mouseup', () => {
//     isDown = false;
// });
// document.querySelector('.gallery').addEventListener('mousemove', (e) => {
//     if (!isDown) return;
//     e.preventDefault();
//     const x = e.pageX - document.querySelector('.gallery').offsetLeft;
//     const walk = (x - startX) * 3; // Увеличиваем скорость перемещения
//     document.querySelector('.gallery').scrollLeft = scrollLeft - walk;
// });
