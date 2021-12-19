import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = { url: String }

    onDelete() {
        this.element.remove();

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
                document.getElementById('price').textContent = json.price;
            });
    }
}
