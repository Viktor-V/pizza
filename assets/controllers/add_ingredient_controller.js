import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['field'];

    onSelect(event) {
        if (this.element.selectedIndex === 0) {
            return;
        }

        this.load(this.fieldTargets[this.element.selectedIndex].dataset.url);
        this.element.selectedIndex = 0;
    }

    load(url) {
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(json => {
                document.getElementById('pizza-ingredients').insertAdjacentHTML('beforeend', json.ingredient);
                document.getElementById('price').textContent = json.price;
            });
    }
}
