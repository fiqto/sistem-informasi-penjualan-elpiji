import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import 'flowbite-datepicker';

// Initialization for ES Users
import {
  Chart,
  initTE,
} from "tw-elements";

initTE({ Chart });

import toastr from 'toastr';
window.toastr = toastr;

toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-top-right',
    timeOut: 3000, // Waktu notifikasi ditampilkan (dalam milidetik)
    extendedTimeOut: 1000 // Waktu tambahan notifikasi ditampilkan saat mouse mengarah padanya
};

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();
