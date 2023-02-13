import './bootstrap';

import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';

Alpine.plugin(persist)

Alpine.store('isGrid', {
    on: true,
 
    toggle() {
        this.on = ! this.on
    }
})
 

Alpine.start();