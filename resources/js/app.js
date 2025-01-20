import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();




// setTimeout(() => {
//     msg_hide.classlist.add('hidden')
// }, 2000);
setTimeout(() => {
    const msg_hide = document.getElementsByClassName('msg-hide');
    msg_hide.classlist.add('hidden')
},2000);