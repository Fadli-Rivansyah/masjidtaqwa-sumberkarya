// tabs utuk hedeader landing page
const tabs = document.querySelectorAll('.tab_btn');
const all_content = document.querySelectorAll('.content')
// tabs untuk zakat muzakki dan mustahik
const tabs_zakat = document.querySelectorAll('.tab-btn-zakat');
const all_content_zakat = document.querySelectorAll('.content_zakat')
let value = document.querySelectorAll('.value')
let interval=3000;
//membuat tabs
tabs.forEach((tab, i) => {
   tab.addEventListener('click', (e)=> {
       //hilangkan class
       tabs.forEach(tab => {
           tab.classList.remove('active-menu');
       });
       //tambah class
       tab.classList.add('active-menu');
       //content
       all_content.forEach(content=> {
           content.classList.remove('active-menu');
       })
       all_content[i].classList.add('active-menu'); 
   });
});
// tabs untuk zakat
tabs_zakat.forEach((tab, i) => {
   tab.addEventListener('click', (e)=> {
       tabs_zakat.forEach(tab => {
           tab.classList.remove('active-content-zakat');
       });
       tab.classList.add('active-content-zakat');
       all_content_zakat.forEach(content => {
           content.classList.remove('active-content-zakat');
       });
       all_content_zakat[i].classList.add('active-content-zakat'); 
   });
});
  //swiper
//   const swiper = new Swiper('.swiper', {
//     // Optional parameters
//     direction: 'horizontal',
//     loop: true,
//     autoplay: {
//         delay: 4800,
//         disableOnInteraction: false
//     },
//     // If we need pagination
//     pagination: {
//         el: '.swiper-pagination',
//     },
//  });
// animasi value
value.forEach(jumValue => {
   let awal = 0;
   let akhir = parseInt(jumValue.getAttribute("data-value"));
   let durasi = Math.floor(interval / akhir);
   let counter = setInterval(() => {
       awal += 1;
       jumValue.textContent = awal +'+';
       if(awal == akhir){
           clearInterval(counter);
       }
   }, durasi);
});

