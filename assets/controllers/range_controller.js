import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["input", "value"];

    connect() {
        this.updateValue();
    }

    updateValue() {
        this.valueTarget.textContent = this.inputTarget.value;
    }
}
