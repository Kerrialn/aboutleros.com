import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        this.createWaves();
        window.addEventListener('resize', () => this.createWaves());
    }

    disconnect() {
        window.removeEventListener('resize', () => this.createWaves());
    }

    createWaves() {
        this.element.innerHTML = '';

        const svgNS = "http://www.w3.org/2000/svg";
        const { clientWidth, clientHeight } = this.element;

        const svg = document.createElementNS(svgNS, "svg");
        svg.setAttribute("width", clientWidth);
        svg.setAttribute("height", clientHeight);
        svg.style.display = 'block';

        const numberOfWaves = 20;
        const waveHeight = clientHeight / numberOfWaves;

        for (let i = 0; i < numberOfWaves; i++) {
            const path = document.createElementNS(svgNS, "path");
            const thickness = waveHeight / 2;

            const d = `
                M 0 ${i * waveHeight}
                Q ${clientWidth / 4} ${i * waveHeight + (i % 2 === 0 ? thickness : -thickness)},
                  ${clientWidth / 2} ${i * waveHeight}
                T ${clientWidth} ${i * waveHeight}
                V ${clientHeight}
                H 0
                Z`;

            path.setAttribute("d", d);
            path.setAttribute("fill", i % 2 === 0 ? "#000" : "#f2eee6");

            svg.appendChild(path);
        }

        this.element.appendChild(svg);
        this.element.style.overflow = 'hidden';
    }
}
