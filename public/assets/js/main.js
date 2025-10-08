$('.portfolio .image-wrapper').magnificPopup({
  delegate: 'a', // child items selector, by clicking on it popup will open
  type: 'image'
  // other options
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