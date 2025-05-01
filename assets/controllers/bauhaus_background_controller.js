import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = {
        shapesCount: { type: Number, default: 25 },
    }

    connect() {
        this.generateBackground();
        window.addEventListener('resize', () => this.generateBackground());
    }

    disconnect() {
        window.removeEventListener('resize', () => this.generateBackground());
    }

    generateBackground() {
        this.element.innerHTML = ''; // Clear previous background

        const shapes = ['circle', 'rect', 'triangle'];
        const colors = ['#E63946', '#F1FAEE', '#A8DADC', '#457B9D', '#FFC857', '#2A9D8F', '#E76F51', '#264653'];
        const { clientWidth, clientHeight } = this.element;

        for (let i = 0; i < this.shapesCountValue; i++) {
            const shapeType = shapes[Math.floor(Math.random() * shapes.length)];
            const color = colors[Math.floor(Math.random() * colors.length)];
            const size = Math.floor(Math.random() * 100) + 30;

            const x = Math.random() * (clientWidth - size);
            const y = Math.random() * (clientHeight - size);

            const shape = document.createElement('div');
            shape.style.position = 'absolute';
            shape.style.left = `${x}px`;
            shape.style.top = `${y}px`;
            shape.style.width = `${size}px`;
            shape.style.height = `${size}px`;
            shape.style.backgroundColor = color;
            shape.style.opacity = '0.6';

            switch (shapeType) {
                case 'circle':
                    shape.style.borderRadius = '50%';
                    break;
                case 'triangle':
                    shape.style.width = '0';
                    shape.style.height = '0';
                    shape.style.borderLeft = `${size / 2}px solid transparent`;
                    shape.style.borderRight = `${size / 2}px solid transparent`;
                    shape.style.borderBottom = `${size}px solid ${color}`;
                    shape.style.backgroundColor = 'transparent';
                    break;
                // default is rect, no extra style needed
            }

            this.element.appendChild(shape);
        }

        this.element.style.position = 'relative';
        this.element.style.overflow = 'hidden';
    }
}
