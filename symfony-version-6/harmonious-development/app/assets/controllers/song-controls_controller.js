import { Controller } from '@hotwired/stimulus';
import axios from 'axios';

export default class extends Controller {

    static values = {
        infoUrl: String
    }

    async play(event) {
        event.preventDefault();

        const response = await axios.get(this.infoUrlValue);
        const audio = new Audio(response.data.url);
        audio.play();

    }
}
