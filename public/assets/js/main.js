$('.portfolio .image-wrapper').magnificPopup({
  delegate: 'a', // child items selector, by clicking on it popup will open
  type: 'image'
});
// $('.portfolio .image-wrapper').magnificPopup({
//     items: [
//         {
//             src: '/assets/images/deshivendor.png'
//         },
//         {
//             src: '/assets/images/Smart-Learning.png'
//         },
//         {
//             src: '/assets/images/ultimateorganiclife.png'
//         },
//     ],
//     gallery: {
//       enabled: true
//     },
//     type: 'image'
// });

const carousels = document.querySelectorAll('.carousel')
carousels.forEach(carousel => {
    const slider = carousel.querySelector('.slider')
    const prev = carousel.querySelector('.controls .prev')
    const next = carousel.querySelector('.controls .next')
    let direction = -1
    const slide_count = slider.children.length
    slider.style.width = `${slide_count}00%`
    
    const sliding_proportion_number = 100 / slide_count;
    
    const sliding_proportion = `${sliding_proportion_number}%`; //  sliding_proportion = 100/number_of_slide
    
    if(prev){
        prev.addEventListener('click',(e)=>{
            if(direction === 1){
                slider.style.transform = `translateX(${sliding_proportion})`
            }else{
                carousel.style.justifyContent = 'flex-end'
                slider.appendChild(slider.firstElementChild)
                slider.style.transform = `translateX(${sliding_proportion})`
                direction = 1
            }
            setTimeout(()=>{
                slider.style.transition = 'none'
                slider.prepend(slider.lastElementChild)
                slider.style.transform = "translateX(0)"
                setTimeout(()=>{
                    slider.style.transition = '0.3s'
                },100)
            },300)
        })
    }
    
    if(next){
        next.addEventListener('click',(e)=>{
            if(direction === -1){
                slider.style.transform = `translateX(-${sliding_proportion})`
            }else{
                carousel.style.justifyContent = 'flex-start'
                slider.prepend(slider.lastElementChild)
                slider.style.transform = `translateX(-${sliding_proportion})`
                direction = -1
            }
            setTimeout(()=>{
                slider.style.transition = 'none'
                slider.appendChild(slider.firstElementChild)
                slider.style.transform = "translateX(0)"
                setTimeout(()=>{
                    slider.style.transition = '0.3s'
                },100)
            },300)
        })
    }
})

document.querySelectorAll('pre code').forEach((el) => {
  hljs.highlightElement(el);
  const button = document.createElement('button');
  button.innerText = 'Copy';
  button.classList.add('copy-btn');
  el.parentElement.style.position = 'relative';
  button.style.position = 'absolute';
  button.style.top = '8px';
  button.style.right = '8px';
  button.addEventListener('click', () => {
    navigator.clipboard.writeText(el.innerText);
    button.innerText = 'Copied!';
    setTimeout(() => (button.innerText = 'Copy'), 2000);
  });
  el.parentElement.appendChild(button);
});