import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = { url: String }

    onSelect() {
        this.element.selectedIndex = 0;

        this.load();
    }

    load() {
        fetch(this.urlValue, {
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
