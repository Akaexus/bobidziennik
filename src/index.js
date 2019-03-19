import './styles/main.scss';
let footer = document.querySelector("footer");
let header = document.querySelector("header");
let body = document.getElementsByTagName('body');

let footerHeight = footer.clientHeight;
let headerHeight = header.clientHeight;
console.log(footerHeight);
console.log(headerHeight);
// console.log(header);

body.style.height=100%-(footerHeight+headerHeight);
