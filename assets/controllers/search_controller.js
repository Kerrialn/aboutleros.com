import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["row", "query"];

    connect() {
        // nothing needed on connect
    }

    filter() {
        const q = this.queryTarget.value.trim().toLowerCase();
        this.rowTargets.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = q === "" || text.includes(q) ? "" : "none";
        });
    }
}
