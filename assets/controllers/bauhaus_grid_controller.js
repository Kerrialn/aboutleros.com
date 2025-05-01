import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        this.generateGrid();
        window.addEventListener('resize', this.generateGrid.bind(this));
    }

    disconnect() {
        window.removeEventListener('resize', this.generateGrid.bind(this));
    }

    generateGrid() {
        this.element.innerHTML = '';

        const colors = ['#65153E', '#A62122', '#EF9137', '#1E4A5A', '#ED6E2D', '#000000'];
        const rows = 10;
        const cols = 8;

        const { clientWidth, clientHeight } = this.element;
        const cellWidth = clientWidth / cols;
        const cellHeight = clientHeight / rows;

        for (let y = 0; y < rows; y++) {
            for (let x = 0; x < cols; x++) {
                const rect = document.createElement('div');
                rect.style.position = 'absolute';
                rect.style.left = `${x * cellWidth}px`;
                rect.style.top = `${y * cellHeight}px`;
                rect.style.width = `${cellWidth}px`;
                rect.style.height = `${cellHeight}px`;

                rect.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                rect.style.border = '4px solid white';

                // Randomly merge cells horizontally or vertically for Bauhaus feel
                if (Math.random() < 0.2 && x < cols - 1) {
                    rect.style.width = `${cellWidth * 2}px`;
                }

                if (Math.random() < 0.2 && y < rows - 1) {
                    rect.style.height = `${cellHeight * 2}px`;
                }

                this.element.appendChild(rect);
            }
        }

        this.element.style.position = 'relative';
        this.element.style.backgroundColor = '#fff';
        this.element.style.overflow = 'hidden';
    }
}
