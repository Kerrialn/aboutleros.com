import { Controller } from '@hotwired/stimulus';
import anime from 'animejs'

export default class extends Controller {
    connect() {
        anime({
            targets: this.element,
            strokeDashoffset: [anime.setDashoffset, 0],
            easing: 'easeInOutSine',
            duration: 1500,
            delay: function(el, i) { return i * 250 },
            direction: 'alternate',
            loop: true
        });
    }
}
