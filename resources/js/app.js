require('./bootstrap');

import Alpine from 'alpinejs'
import intersect from '@alpinejs/intersect'
import snow from './scripts/snow';

Alpine.plugin(intersect)

window.Alpine = Alpine

Alpine.start()

snow();
