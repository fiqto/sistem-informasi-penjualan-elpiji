import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import 'flowbite-datepicker';

import {
    Chart,
    initTE,
  } from "tw-elements";
  
  initTE({ Chart });
  
  // Chart
  const dataBar = {
    type: 'bar',
    data: {
      labels: ['Senin', 'Selasa' , 'Rabu' , 'Kamis' , 'Jumat' , 'Sabtu' , 'Minggu '],
      datasets: [
        {
          label: 'Penjualan',
          data: [10, 30, 40, 50, 60, 30, 80],
        },
      ],
    },
  };
  
new Chart(document.getElementById('bar-chart'), dataBar);

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
